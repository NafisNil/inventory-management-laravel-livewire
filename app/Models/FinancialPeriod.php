<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialPeriod extends Model
{
    use HasFactory;
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $active_financial_period = FinancialPeriod::where([
                'company_id' => $model->company_id,
                'status' => 'active'
            ])->first();
            if ($active_financial_period && $model->status == 'active') {
                throw new \Exception('There is an active financial period already');
            }
        });


        static::updating(function ($model) {
            $active_financial_period = FinancialPeriod::where([
                'company_id' => $model->company_id,
                'status' => 'active'
            ])->first();
            if ($model->status == 'active') {
                # code...
                if ($active_financial_period && $active_financial_period->id != $model->id) {
                    throw new \Exception('There is an active financial period already');
                }
            }
            
        });
    }
}
