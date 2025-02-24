<?php

namespace App\Admin\Controllers;

use App\Models\StockSubCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('company_id', __('Company id'));
        $grid->column('stock_category_id', __('Stock category id'));
        $grid->column('description', __('Description'));
        $grid->column('status', __('Status'));
        $grid->column('image', __('Image'));
        $grid->column('buying_price', __('Buying price'));
        $grid->column('selling_price', __('Selling price'));
        $grid->column('expected_price', __('Expected price'));
        $grid->column('earned_price', __('Earned price'));
        $grid->column('measurement_unit', __('Measurement unit'));
        $grid->column('current_quantity', __('Current quantity'));
        $grid->column('reorder_level', __('Reorder level'));
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
        $form = new Form(new StockSubCategory());

        $form->text('name', __('Name'));
        $form->number('company_id', __('Company id'));
        $form->number('stock_category_id', __('Stock category id'));
        $form->text('description', __('Description'));
        $form->text('status', __('Status'))->default('active');
        $form->image('image', __('Image'));
        $form->number('buying_price', __('Buying price'));
        $form->number('selling_price', __('Selling price'));
        $form->number('expected_price', __('Expected price'));
        $form->number('earned_price', __('Earned price'));
        $form->text('measurement_unit', __('Measurement unit'));
        $form->number('current_quantity', __('Current quantity'));
        $form->number('reorder_level', __('Reorder level'));

        return $form;
    }
}
