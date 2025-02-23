<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\User;
use DB;
class CompanyController extends AdminController
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
        $grid->quickSearch('name', 'email', 'website', 'status', 'address', 'phone_number');
        $grid->column('id', __('Id'));
        $grid->column('owner_id', __('Owner id'))->display(function($owner_id){
            
             $user = User::find($owner_id);
             
             if ($user == null) {
                 # code...
                 return 'Owner not found';
             }
       
             return $user->name;
 
         });
       
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('logo', __('Logo'));
        $grid->column('website', __('Website'));
        $grid->column('about', __('About'))->hide();
        $grid->column('status', __('Status'));
        $grid->column('licensed_expire', __('Licensed expire'));
        $grid->column('address', __('Address'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('phone_number2', __('Phone number2'));
        $grid->column('color', __('Color'))->hide();
        $grid->column('slogan', __('Slogan'))->hide();
        $grid->column('facebook', __('Facebook'))->hide();
        $grid->column('twitter', __('Twitter'))->hide();
        $grid->column('created_at', __('Registered at'))->display(function ($created_at) {
            return date('d M,Y', strtotime($created_at));
        })->sortable();
        $grid->column('updated_at', __('Updated at'))->display(function ($created_at) {
            return date('d M,Y', strtotime($created_at));
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
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('owner_id', __('Owner id'));
        $show->field('name', __('Name'));
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
        $show->field('created_at', __('Registered at'))->display(function ($created_at) {
            return date('d M,Y', strtotime($created_at));
        });
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
        $admin_role_users = DB::table('admin_role_users')->where([
            'role_id' => 2
        ])->get();

        $company_admin = [];
        foreach ($admin_role_users as $key=>$admin_role_user) {
            $user= User::find($admin_role_user->user_id);
            if ($user == null) {
                # code...
                continue;
            }
            $company_admin[$user->id] = $user->name.'-'.$user->id;
        }
        $form = new Form(new Company());

        $form->select('owner_id', __('Owner'))->options($company_admin)->rules('required');
        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->image('logo', __('Logo'));
        $form->url('website', __('Website'));
        $form->textarea('about', __('About'));
        $form->text('status', __('Status'));
        $form->date('licensed_expire', __('Licensed expire'))->default(date('Y-m-d'));
        $form->textarea('address', __('Address'));
        $form->text('phone_number', __('Phone number'));
        $form->text('phone_number2', __('Phone number2'));
        $form->color('color', __('Color'));
        $form->text('slogan', __('Slogan'));
        $form->url('facebook', __('Facebook'));
        $form->url('twitter', __('Twitter'));

        return $form;
    }
}
