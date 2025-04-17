<?php

namespace App\Admin\Controllers;

use App\Models\FinancialPeriod;
use App\Models\StockCategory;
use App\Models\StockItem;
use App\Models\StockSubCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use App\Models\User;
use App\Models\Utils;
class StockItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Stock Items';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StockItem());
        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            $filter->like('name', __('Name'));
            $filter->like('sku', __('SKU'));
            $filter->between('created_at', __('Created at'))->datetime();
        });
        $user = Admin::user();
       
        $grid->column('id', __('Id'));

        $grid->column('created_by_id', __('Created by id'))->display(function($created_by_id){
            $user = User::find($created_by_id);
            if ($user) {
                # code...
                return $user->name;
            } else {
                # code...
                return 'N/A';
            }
            
        });
        $grid->column('financial_period_id', __('Financial period '))->display(function($financial_period_id){
            $financial_period = FinancialPeriod::find($financial_period_id);
            if ($financial_period) {
                # code...
                return $financial_period->name;
            } else {
                # code...
                return 'N/A';
            }

        });
        $grid->column('stock_category_id', __('Stock category '))->display(function($stock_category_id){
            $sub_cat = StockCategory::find($stock_category_id);
            if ($sub_cat) {
                # code...
                return $sub_cat->name;
            } else {
                # code...
                return 'N/A';
            }
            
        });
        $grid->column('stock_sub_category_id', __('Stock sub category '))->display(function($stock_sub_category_id){
            $sub_cat = StockSubCategory::find($stock_sub_category_id);
            if ($sub_cat) {
                # code...
                return $sub_cat->name;
            } else {
                # code...
                return 'N/A';
            }
            
        });
        $grid->column('name', __('Name'))->sortable();
        $grid->column('description', __('Description'))->hide();
        $grid->column('image', __('Image'))->lightbox(
            [
                'width' => 60,
                'height' => 60,
            ]
        );
        $grid->column('sku', __('Sku'));
        $grid->column('barcode', __('Barcode'));
        $grid->column('model', __('Model'));
        $grid->column('brand', __('Brand'));
        $grid->column('color', __('Color'));
        $grid->column('size', __('Size'));
        $grid->column('generate_sku', __('Generate sku'));
        $grid->column('update_sku', __('Update sku'));
        $grid->column('weight_unit', __('Weight unit'));
        $grid->column('gallery', __('Gallery'));
        $grid->column('buying_price', __('Buying price'));
        $grid->column('selling_price', __('Selling price'));
        $grid->column('original_quantity', __('Original Quantity (In Unit)'));
        $grid->column('current_quantity', __('Current Quantity (In Unit)'));
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
        $show = new Show(StockItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_id', __('Company id'));
        $show->field('created_by_id', __('Created by id'))->display(function($created_by_id){
            $user = User::find($created_by_id);
            if ($user) {
                # code...
                return $user->name;
            } else {
                # code...
                return 'N/A';
            }
            
        })->readonly();
        $show->field('financial_period_id', __('Financial period id'));
        $show->field('stock_category_id', __('Stock category id'));
        $show->field('stock_sub_category_id', __('Stock sub category id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('image', __('Image'));
        $show->field('sku', __('Sku'));
        $show->field('barcode', __('Barcode'));
        $show->field('model', __('Model'));
        $show->field('brand', __('Brand'));
        $show->field('color', __('Color'));
        $show->field('size', __('Size'));
        $show->field('generate_sku', __('Generate sku'));
        $show->field('update_sku', __('Update sku'));
        $show->field('weight_unit', __('Weight unit'));
        $show->field('gallery', __('Gallery'));
        $show->field('buying_price', __('Buying price'));
        $show->field('selling_price', __('Selling price'));
        $show->field('original_quantity', __('Original Quantity'));
        $show->field('current_quantity', __('Current Quantity'));
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
        $form = new Form(new StockItem());
        $user = Admin::user();
        $financial_period = Utils::getActiveFinancialPeriod($user->company_id);
        if ($financial_period == null) {
            # code...
            return admin_error("Please create a financial periods!");
        }
        $form->text('company_id',__('Company ID'))->default($user->company_id)->readonly();
        if ($form->isCreating()) {
            # code...
            $form->text('created_by_id', __('Created By ') )->readonly();
        }
       
        $sub_cat_ajax_url = url('api/stock-sub-categories');
        $sub_cat_ajax_url = $sub_cat_ajax_url. '?company_id='. $user->company_id;
       // dd($sub_cat_ajax_url);
   
        $form->number('financial_period_id', __('Financial period id'))->readonly();
        $form->select('stock_sub_category_id', __('Stock category '))->ajax($sub_cat_ajax_url)->options(function ($id) {
           $sub_cat = StockSubCategory::find($id);
           if ($sub_cat) {
            # code...
                 return [$sub_cat->id => $sub_cat->name_text.' ('.$sub_cat->measurement_unit.')'];
           } else {
            # code...
                return [];
           }
        })->rules('required');


       //$form->number('stock_sub_category_id', __('Stock sub category id'));
        $form->text('name', __('Name'))->rules('required');
        $form->textarea('description', __('Description'));
        $form->image('image', __('Image'))->uniqueName();
    //    $form->text('sku', __('Sku'));
      //  $form->text('barcode', __('Barcode'));
        $form->text('model', __('Model'));
        $form->text('brand', __('Brand'));
        $form->color('color', __('Color'));
        $form->text('size', __('Size'));
        

        if ($form->isEditing()) {
            # code...
            $form->radio('update_sku', __('Update sku'))->options([
                'Yes' => "Yes",
                'No' => 'No'
            ])->when('Yes', function(Form $form){
                $form->text('sku', __('Enter SKU'))->rules('required');
            })->rules('required')->default('No');
        }else{
            
            $form->radio('generate_sku', __('Generate sku'))->options([
                'Manual' => "Manual",
                'Auto' => 'Auto'
            ])->when('Manual', function(Form $form){
                $form->text('sku', __('Enter SKU'))->rules('required');
            })->rules('required');
        }
        
        $form->text('weight_unit', __('Weight unit'));
        $form->multipleImage('gallery', __('Item Gallery'))->removable()->uniqueName()->downloadable();
        $form->decimal('buying_price', __('Buying price'))->default('0.00')->rules('required|numeric|min:0');
        $form->decimal('selling_price', __('Selling price'))->default('0.00')->rules('required|numeric|min:0');
     
        $form->decimal('original_quantity', __('Original Quantity (In Unit)'))->default(0)->rules('required|numeric|min:0');


        return $form;
    }
}
