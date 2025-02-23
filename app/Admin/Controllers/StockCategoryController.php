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

        $grid->column('id', __('Id'));
        $grid->column('company_id', __('Company id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('status', __('Status'));
        $grid->column('image', __('Image'));
        $grid->column('buying_price', __('Buying price'));
        $grid->column('selling_price', __('Selling price'));
        $grid->column('expected_price', __('Expected price'));
        $grid->column('earned_price', __('Earned price'));
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
        $show->field('expected_price', __('Expected price'));
        $show->field('earned_price', __('Earned price'));
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
        $form->text('name', __('Name'));
        $form->text('description', __('Description'));
        $form->text('status', __('Status'))->default('active');
        $form->image('image', __('Image'));
        $form->number('buying_price', __('Buying price'));
        $form->number('selling_price', __('Selling price'));
        $form->number('expected_price', __('Expected price'));
        $form->number('earned_price', __('Earned price'));

        return $form;
    }
}
