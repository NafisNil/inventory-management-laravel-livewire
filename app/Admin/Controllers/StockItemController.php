<?php

namespace App\Admin\Controllers;

use App\Models\StockItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
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
        $user = Admin::user();
       
        $grid->column('id', __('Id'));

        $grid->column('created_by_id', __('Created by id'));
        $grid->column('financial_period_id', __('Financial period id'));
        $grid->column('stock_category_id', __('Stock category id'));
        $grid->column('stock_sub_category_id', __('Stock sub category id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('image', __('Image'));
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
        $grid->column('original_price', __('Original price'));
        $grid->column('current_price', __('Current price'));
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
        $show->field('created_by_id', __('Created by id'));
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
        $show->field('original_price', __('Original price'));
        $show->field('current_price', __('Current price'));
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
       
        $form->text('company_id',__('Company ID'))->default($user->company_id)->readonly();
        if ($form->isCreating()) {
            # code...
            $form->text('created_by_id', __('Created By ') )->default($user->id)->readonly();
        }
       
        $sub_cat_ajax_url = url('api/stock-sub-categories');
        $sub_cat_ajax_url = $sub_cat_ajax_url. '?company_id='. $user->company_id;
       // dd($sub_cat_ajax_url);
        $form->number('created_by_id', __('Created by id'));
        $form->number('financial_period_id', __('Financial period id'));
        $form->select('stock_sub_category_id', __('Stock category '))->ajax($sub_cat_ajax_url)->rules('required');
       //$form->number('stock_sub_category_id', __('Stock sub category id'));
        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->image('image', __('Image'));
        $form->text('sku', __('Sku'));
        $form->text('barcode', __('Barcode'));
        $form->text('model', __('Model'));
        $form->text('brand', __('Brand'));
        $form->color('color', __('Color'));
        $form->text('size', __('Size'));
        $form->text('generate_sku', __('Generate sku'));
        $form->text('update_sku', __('Update sku'));
        $form->text('weight_unit', __('Weight unit'));
        $form->text('gallery', __('Gallery'));
        $form->number('buying_price', __('Buying price'));
        $form->number('selling_price', __('Selling price'));
        $form->number('original_price', __('Original price'));
        $form->number('current_price', __('Current price'));

        return $form;
    }
}
