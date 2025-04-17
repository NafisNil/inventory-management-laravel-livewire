<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyEditController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Company';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Company());
        $grid->disableCreateButton();
        $user = Admin::user();
        $grid->model()->where('id', $user->company_id);
        $grid->column('id', __('Id'));

        $grid->column('name', __('Name'));
        $grid->column('currency', __('Currency'));
        $grid->column('settings_worker_can_create_stock_item', __('Settings worker can create stock item'));
        $grid->column('settings_worker_can_create_stock_category', __('Settings worker can create stock category'));
        $grid->column('email', __('Email'));
        $grid->column('logo', __('Logo'))->image('',100,80);
        $grid->column('website', __('Website'));
        $grid->column('about', __('About'))->hide();
        $grid->column('status', __('Status'));
        $grid->column('licensed_expire', __('Licensed expire'));
   
      
        $grid->column('settings_worker_can_create_stock_record', __('Settings worker can create stock record'));
        $grid->column('settings_worker_can_view_balance', __('Settings worker can view balance'));
        $grid->column('settings_worker_can_view_stats', __('Settings worker can view stats'));
        $grid->actions(function ($actions) {
            $actions->disableDelete();

        });
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
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('owner_id', __('Owner id'));
        $show->field('name', __('Name'));
        $show->field('currency', __('Currency'));
        $show->field('settings_worker_can_create_stock_item', __('Settings worker can create stock item'));
        $show->field('settings_worker_can_create_stock_category', __('Settings worker can create stock category'));
        $show->field('email', __('Email'));
        $show->field('logo', __('Logo'));
        $show->field('website', __('Website'));
        $show->field('about', __('About'));
        $show->field('status', __('Status'));
        $show->field('licensed_expire', __('Licensed expire'));
        $show->field('address', __('Address'));
        $show->field('phone_number', __('Phone number'));
        $show->field('phone_number2', __('Phone number2'));
        $show->field('color', __('Color'));
        $show->field('slogan', __('Slogan'));
        $show->field('facebook', __('Facebook'));
        $show->field('twitter', __('Twitter'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('settings_worker_can_create_stock_record', __('Settings worker can create stock record'));
        $show->field('settings_worker_can_view_balance', __('Settings worker can view balance'));
        $show->field('settings_worker_can_view_stats', __('Settings worker can view stats'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Company());

        $form->number('owner_id', __('Owner id'));
        $form->text('name', __('Name'));
        $form->text('currency', __('Currency'))->default('USD');
        $form->text('settings_worker_can_create_stock_item', __('Settings worker can create stock item'))->default('Yes');
        $form->text('settings_worker_can_create_stock_category', __('Settings worker can create stock category'))->default('Yes');
        $form->email('email', __('Email'));
        $form->textarea('logo', __('Logo'));
        $form->text('website', __('Website'));
        $form->textarea('about', __('About'));
        $form->text('status', __('Status'));
        $form->date('licensed_expire', __('Licensed expire'))->default(date('Y-m-d'));
        $form->textarea('address', __('Address'));
        $form->text('phone_number', __('Phone number'));
        $form->text('phone_number2', __('Phone number2'));
        $form->color('color', __('Color'));
        $form->text('slogan', __('Slogan'));
        $form->text('facebook', __('Facebook'));
        $form->text('twitter', __('Twitter'));
        $form->text('settings_worker_can_create_stock_record', __('Settings worker can create stock record'))->default('Yes');
        $form->text('settings_worker_can_view_balance', __('Settings worker can view balance'))->default('Yes');
        $form->text('settings_worker_can_view_stats', __('Settings worker can view stats'))->default('Yes');

        return $form;
    }
}
