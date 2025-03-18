<?php

namespace App\Admin\Controllers;

use App\Models\FinancialPeriod;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FinancialPeriodController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Financial Period';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FinancialPeriod());

     //   $grid->column('id', __('Id'));
        $user = Admin::user();
        $grid->model()->where('company_id', $user->company_id)->orderBy('start_date', 'desc');
        $grid->column('company_id', __('Company id'));
        $grid->column('name', __('Name'));
        $grid->column('start_date', __('Start date'))->display(function ($start_date) {
            return date('d M,Y', strtotime($start_date));
        })->sortable();
        $grid->column('end_date', __('End date'))->display(function ($end_date) {
            return date('d M,Y', strtotime($end_date));
        })->sortable();
        $grid->column('status', __('Status'))->label([
            'active' => 'success',
            'inactive' => 'danger',
            'class' => 'rounded',
            'zooming' => true
        ]);
        $grid->column('description', __('Description'))->hide();
        $grid->column('total_investment', __('Total investment'))->sortable( );
        $grid->column('total_sales', __('Total sales'))->sortable( );
        $grid->column('total_profit', __('Total profit'))->sortable( );
        $grid->column('total_expenses', __('Total expenses'))->sortable( );
        $grid->column('created_at', __('Created at'))->display(function ($created_at) {
            return date('d M,Y', strtotime($created_at));
        })->sortable();
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
        $show = new Show(FinancialPeriod::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_id', __('Company id'));
        $show->field('name', __('Name'));
        $show->field('start_date', __('Start date'));
        $show->field('end_date', __('End date'));
        $show->field('status', __('Status'));
        $show->field('description', __('Description'));
        $show->field('total_investment', __('Total investment'));
        $show->field('total_sales', __('Total sales'));
        $show->field('total_profit', __('Total profit'));
        $show->field('total_expenses', __('Total expenses'));
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
        $form = new Form(new FinancialPeriod());
        $user = Admin::user();
        $form->hidden('company_id')->value($user->company_id);
       
        $form->text('name', __('Name'))->rules('required');

        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->date('end_date', __('End date'))->default(date('Y-m-d'));

        $form->radio('status', __('Status'))->options(['active' => 'Active', 'inactive' => 'Inactive'])
        ->default('active')->rules('required');
        $form->textarea('description', __('Description'));


        return $form;
    }
}
