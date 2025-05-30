<?php

namespace App\Admin\Controllers;

use App\Models\StockItem;
use App\Models\StockRecord;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use App\Models\User;

class StockRecordController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Stock Out Record';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StockRecord());
        $grid->quickSearch('name', 'sku')->placeholder('Search by name, sku');
        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            $filter->like('name', __('Name'));
            $filter->like('sku', __('SKU'));
            $filter->between('created_at', __('Created at'))->datetime();
        });
        $user = Admin::user();
        $grid->column('id', __('Id'))->sortable();
        $grid->column('company_id', __('Company id'))->display(function($company_id){
            $user = User::find($company_id);
            if ($user) {
                # code...
                return $user->name;
            } else {
                # code...
                return 'N/A';
            }
        });
        $grid->column('stock_category_id', __('Stock category'))->display(function($stock_category_id){
            $stock_item = StockItem::find($stock_category_id);
            if ($stock_item) {
                # code...
                return $stock_item->stockCategory->name;
            } else {
                # code...
                return 'N/A';
            }
        });
        $grid->column('stock_sub_category_id', __('Stock sub category id'))->display(function($stock_sub_category_id){
            $stock_item = StockItem::find($stock_sub_category_id);
            if ($stock_item) {
                # code...
                return $stock_item->stockSubCategory->name;
            } else {
                # code...
                return 'N/A';
            }
        });
        $grid->column('stock_item_id', __('Stock item id'));
        $grid->column('created_by_id', __('Created by id'));
        $grid->column('name', __('Name'));
        $grid->column('sku', __('Sku'));
        $grid->column('quantity', __('quantity'))->display(function($quantity){
            return abs($quantity).' - '.$this->measurement_unit;
        })->sortable()->totalRow(function ($amount) {
            return 'Total: ' . abs($amount);
        });
        $grid->column('measurement_unit', __('Measuring unit'));
        $grid->column('selling_price', __('Selling price'))->totalRow(function ($amount) {
            return 'Total: ' . abs($amount) .' BDT';
        });
        $grid->column('total_sales', __('Total sales'));
        $grid->column('description', __('Description'))->hide();
        $grid->column('type', __('Type'));
        $grid->column('created_at', __('Created at'))->display(function(){
            return date('d M Y', strtotime($this->created_at));
        })->sortable();
        $grid->column('updated_at', __('Updated at'))->display(function(){
            return date('d M Y', strtotime($this->updated_at));
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
        $show = new Show(StockRecord::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_id', __('Company id'));

        $show->field('stock_category_id', __('Stock category id'));
        $show->field('stock_sub_category_id', __('Stock sub category id'));
        $show->field('stock_item_id', __('Stock item id'));
        $show->field('created_by_id', __('Created by id'));
        $show->field('name', __('Name'));
        $show->field('sku', __('Sku'));
        $show->field('quantity', __('quantity'));
        $show->field('measurement_unit', __('Measuring unit'));
        $show->field('selling_price', __('Selling price'));
        $show->field('total_sales', __('Total sales'));
        $show->field('description', __('Description'));
        $show->field('type', __('Type'));
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
        $form = new Form(new StockRecord());
        $user = Admin::user();
        $form->number('company_id', __('Company id'))->default($user->company_id)->readonly();

        $sub_item_ajax_url = url('api/stock-items');
        $sub_item_ajax_url = $sub_item_ajax_url. '?company_id='. $user->company_id;
       // dd($sub_cat_ajax_url);
   
    
        $form->select('stock_item_id', __('Stock Item '))->ajax($sub_item_ajax_url)->options(function ($id) {
           $sub_cat = StockItem::find($id);
           if ($sub_cat) {
            # code...
                 return [$sub_cat->id => $sub_cat->name];
           } else {
            # code...
                return [];
           }
        })->rules('required');
   
        $form->number('created_by_id', __('Created by id'))->default($user->id)->readonly();
        $form->number('quantity', __('Quantity'))->rules('required|numeric|min:0');
        $form->textarea('description', __('Description'));
        $form->radio('type', __('Type'))->options([
            'Sales' => 'Sales',
            'Damage' => 'Damage',
            'Expired' => 'Expired',
            'Lost' => 'Lost',
            'Internal Use' => 'Internal Use',
            'Other' => 'Other',
            ])->rules('required');

        return $form;
    }
}
