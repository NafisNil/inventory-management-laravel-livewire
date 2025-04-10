<?php

namespace App\Models;

use Dflydev\DotAccessData\Util;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;

        //boot
        protected static function boot()
        {
            parent::boot();
            static::creating(function ($model) {
                $model = Self::prepare($model);
                $model->current_quantity = $model->original_quantity;
                
                return $model;
            });
    
            static::updating(function ($model) {
                $model = Self::prepare($model);
                return $model;
            });

            static::created(function ($model) {
                $stock_category = StockCategory::find($model->stock_category_id);
                if ($stock_category != null) {
                    $stock_category->update_self();
                }
                $stock_sub_category = StockSubCategory::find($model->stock_sub_category_id);
                if ($stock_sub_category != null) {
                    $stock_sub_category->update_self();
                }
            });

            static::updated(function ($model) {
                $stock_category = StockCategory::find($model->stock_category_id);
                if ($stock_category != null) {
                    $stock_category->update_self();
                }

                $stock_sub_category = StockSubCategory::find($model->stock_sub_category_id);
                if ($stock_sub_category != null) {
                    $stock_sub_category->update_self();
                }
            });

            static::deleted(function ($model) {
                $stock_category = StockCategory::find($model->stock_category_id);
                if ($stock_category != null) {
                    $stock_category->update_self();
                }

                $stock_sub_category = StockSubCategory::find($model->stock_sub_category_id);
                if ($stock_sub_category != null) {
                    $stock_sub_category->update_self();
                }
            });
        }
    
        static public function prepare($model){
            $sub_category = StockSubCategory::find($model->stock_sub_category_id);
            if($sub_category == null){
                throw new \Exception('Sub Category not found');
            }
            $model->stock_category_id = $sub_category->stock_category_id;
            $user = User::find($model->created_by_id);
            if ($user == null) {
                throw new \Exception('User not found');
                # code...
            }

            $financial_period = Utils::getActiveFinancialPeriod($user->company_id);
            if ($financial_period == null) {
                throw new \Exception('Financial period not found');
                # code...
            }
            $model->financial_period_id = $financial_period->id;
            $model->company_id = $user->company_id;

            if ($model->sku == null  || strlen($model->sku) > 3) {
                # code...
                $model->sku = Utils::generateSku($model->company_id);
            }
            if ($model->update_sku == "Yes" && $model->generate_sku == "Manual") {
                # code...
                $model->sku = Utils::generateSku($model->company_id);
                $model->generate_sku = "No";
            }
            return $model;
        }
    
    
    public function setGalleryAttribute($pictures)
{
    if (is_array($pictures)) {
        $this->attributes['gallery'] = json_encode($pictures, true);
    }
}

public function getGalleryAttribute($pictures)
{
    if ($pictures != null && strlen($pictures) > 0) {
        # code...
        return json_decode($pictures);
    }
    return [];
}

    public $appends = ['name_text'];

    public function getNameTextAttribute()
    {
        $name_text = $this->name;
        if ($this->stockSubCategory != null) {
            # code...
           
                $name_text = $name_text. "-".$this->stockSubCategory->name;
        }
        $name_text = $name_text. " (".$this->stockSubCategory->measurement_unit.")". " - ". $this->current_quantity;
        return $name_text;

    }

    public function stockSubCategory()
    {
        return $this->belongsTo(StockSubCategory::class, 'stock_sub_category_id', 'id');
    }
}