<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmployeesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Employees';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('username', __('Username'));
        $grid->column('password', __('Password'));
        $grid->column('name', __('Name'));
        $grid->column('avatar', __('Avatar'));
        $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('company_id', __('Company id'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('phone_number_2', __('Phone number 2'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('address', __('Address'));
        $grid->column('sex', __('Sex'));
        $grid->column('dob', __('Dob'));
        $grid->column('status', __('Status'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('name', __('Name'));
        $show->field('avatar', __('Avatar'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('company_id', __('Company id'));
        $show->field('phone_number', __('Phone number'));
        $show->field('phone_number_2', __('Phone number 2'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('address', __('Address'));
        $show->field('sex', __('Sex'));
        $show->field('dob', __('Dob'));
        $show->field('status', __('Status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());
        $user = Admin::user();
        $form->divider('Personal & Account Information');
        $form->text('company_id')->value($user->company_id)->readonly();
        $form->text('email', __('Username'));
     //   $form->password('password', __('Password'));
        $form->text('first_name', __('First name'))->required();
        $form->text('last_name', __('Last name'))->required();
        $form->image('avatar', __('Avatar'));
       // $form->text('remember_token', __('Remember token'));
     
        $form->text('phone_number', __('Phone number'))->required();
        $form->text('phone_number_2', __('Phone number 2'));
       
        $form->textarea('address', __('Address'));
        $form->radio('sex', __('Sex'))->options([
            'Male' => 'Male',
            'Female' => 'Female',
            'Others' => 'Others'
        ]);
        $form->date('dob', __('Dob'))->default(date('Y-m-d'));
        $form->radio('status', __('Status'))->options([
            'Active' => 'Active',
            'Inactive' => 'Inactive'
        ]);

        return $form;
    }
}
