<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialPeriod;
class Utils 
{
    static function getActiveFinancialPeriod($company_id){
        return FinancialPeriod::where('company_id', $company_id)->where('status', 'Active')->first();
    }

    static public function generateSku($sub_category_id){
        $year = date('y');
        $sub_category = StockSubCategory::find($sub_category_id);
        $serial = StockItem::where('stock_sub_category_id', $sub_category_id)->count()+1;
        $sku = $year ."-". $sub_category->id."-".$serial;
        return $sku;
    }
}
