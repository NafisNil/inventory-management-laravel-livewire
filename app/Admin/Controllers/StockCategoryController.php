<?php

namespace App\Admin\Controllers;

use App\Models\StockCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StockCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Stock Categories';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StockCategory());
        $user = Admin::user();
        
       $grid->model()->where('company_id', $user->company_id);

        $grid->quickSearch('name', 'description', 'status');
        $grid->column('id', __('Id'))->sortable();
        $grid->column('company_id', __('Company id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('status', __('Status'));
        $grid->picture('image', __('Image'))->image();
        $grid->column('buying_price', __('Investment'))->display(function($buying_price){
            return number_format($buying_price, 2);
        })->sortable();
        $grid->column('selling_price', __('Selling price'))->display(function($selling_price){
            return number_format($selling_price, 2);
        })->sortable();
        $grid->column('expected_profit', __('Expected Profit'))->display(function($expected_profit){
            return number_format($expected_profit, 2);
        })->sortable();
        $grid->column('earned_profit', __('Earned Profit'))->display(function($earned_profit){
            return number_format($earned_profit, 2);
        })->sortable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(StockCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_id', __('Company id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('image', __('Image'));
        $show->field('buying_price', __('Buying price'));
        $show->field('selling_price', __('Selling price'));
        $show->field('expected_profit', __('Expected Profit'));
        $show->field('earned_profit', __('Earned Profit'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new StockCategory());
        $user = Admin::user();

        $form->number('company_id', __('Company id'))->default($user->company_id)->readonly();
        $form->text('name', __('Category Name'))->rules('required|min:3|max:250');
        $form->textarea('description', __('Category Description'));
        $form->radio('status', __('Status'))->options(['active' => 'Active', 'inactive' => 'Inactive'])
        ->default('active')->rules('required');
        $form->image('image', __('Image'));
       

        return $form;
    }
}
