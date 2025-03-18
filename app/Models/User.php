<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Administrator
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'admin_users';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
          $name = "";
          if ($model->first_name != null  && strlen($model->first_name) > 0) {
              $name = $model->first_name;
          }
            # code...
            if ($model->last_name != null && strlen($model->last_name) > 0) {
                $name = $name . ' ' . $model->last_name;
            }

            $name = trim($name);
            if ($name  != null && strlen($name) > 0) {
                # code...
                $model->name = $name;
            }
         
            $model->username = $model->email;
            $model->password = bcrypt('admin');
     
            return $model;
          });


          static::updating(function ($model) {
            $name = "";
            if ($model->first_name != null  && strlen($model->first_name) > 0) {
                $name = $model->first_name;
            }
              # code...
              if ($model->last_name != null && strlen($model->last_name) > 0) {
                  $name = $name . ' ' . $model->last_name;
              }
  
              $name = trim($name);
              if ($name == null && strlen($name) == 0) {
                  # code...
                  $model->name = $name;
              }

              $model->username = $model->email;
           
              return $model;
            });


    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
