<?php

namespace App\Admin\Controllers;

use App\Models\StockSubCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use App\Models\StockCategory;
class StockSubCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Stock Sub Categories';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StockSubCategory());

        $user = Admin::user();
        $grid->quickSearch('name', 'status');
       $grid->model()->where('company_id', $user->company_id);
       $grid->column('company_id', __('Company id'));
        $grid->column('name', __('Name'));
      
        $grid->column('stock_category_id', __('Stock category id'))->display(function($stock_category_id){
            $categories = StockCategory::find($stock_category_id);
            if($categories){
                return $categories->name;
            }
           return 'N/A';
        });
        $grid->column('description', __('Description'))->hide();
        $grid->column('status', __('Status'))->label([
            'active' => 'success',
            'inactive' => 'danger',
            'class' => 'rounded',
            'zooming' => true
        ]);
        $grid->column('image', __('Image'))->lightbox(['width' => 60, 'height' => 60]);;
        $grid->column('buying_price', __('Investment'))->sortable();
        $grid->column('selling_price', __('Selling price'))->sortable();
        $grid->column('expected_price', __('Expected price'))->sortable();
        $grid->column('earned_price', __('Earned price'))->sortable();
    
        $grid->column('current_quantity', __('Current quantity'))->display(function($current_quantity){
            return number_format($current_quantity, 2).' '.$this->measurement_unit;
        })->sortable();
        $grid->column('reorder_level', __('Reorder level'))->display(function($current_quantity){
            return number_format($current_quantity, 2);
        })->sortable()->editable();
        $grid->column('created_at', __('Created at'))->display(function ($created_at) {
            return date('d M,Y', strtotime($created_at));
        })->sortable();;
        $grid->column('updated_at', __('Updated at'))->display(function ($updated_at) {
            return date('d M,Y', strtotime($updated_at));
        })->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(StockSubCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('company_id', __('Company id'));
        $show->field('stock_category_id', __('Stock category id'));
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('image', __('Image'));
        $show->field('buying_price', __('Buying price'));
        $show->field('selling_price', __('Selling price'));
        $show->field('expected_price', __('Expected price'));
        $show->field('earned_price', __('Earned price'));
        $show->field('measurement_unit', __('Measurement unit'));
        $show->field('current_quantity', __('Current quantity'));
        $show->field('reorder_level', __('Reorder level'));
        $show->field('created_at', __('Created at'))>display(function ($created_at) {
            return date('d M,Y', strtotime($created_at));
        })->sortable();;
        $show->field('updated_at', __('Updated at'))>display(function ($updated_at) {
            return date('d M,Y', strtotime($updated_at));
        })->sortable();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new StockSubCategory());
        $user = Admin::user();
       
        $form->hidden('company_id',__('Company ID'))->default($user->company_id);
       
         $categories =  StockCategory::where(['company_id'=>$user->company_id, 'status'=>'active'])->get()->pluck('name', 'id');
       //  return $categories;
      $form->text('name', __('Name'))->rules('required');
   //     $form->select('company_id', __('Company id'))->options($categories)->rules('required');
        $form->select('stock_category_id', __('Stock category id'))->options($categories)->rules('required');
        $form->text('description', __('Description'));
        $form->radio('status', __('Status'))->options(['active' => 'Active', 'inactive' => 'Inactive'])
        ->default('active')->rules('required');
        $form->image('image', __('Image'));

        $form->text('measurement_unit', __('Measurement unit'))->rules('required');

        $form->decimal('reorder_level', __('Reorder level'))->rules('required');

        return $form;
    }
}
