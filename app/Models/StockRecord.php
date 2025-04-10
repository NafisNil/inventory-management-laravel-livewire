<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockRecord extends Model
{
    use HasFactory;

    public static function boot(){
        parent::boot();
        static::creating(function($model){
           $sub_category = StockSubCategory::find($model->stock_sub_category_id);
            return $model;
    });
    }
    
}
