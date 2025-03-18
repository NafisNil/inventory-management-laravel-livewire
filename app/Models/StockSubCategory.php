<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockSubCategory extends Model
{
    use HasFactory;
    public function stockCategory(){
        return $this->belongsTo(StockCategory::class);
    }

    protected $appends = ['name_text'];

    public function getNameTextAttribute(){
        $name_text = $this->name;
        if ($this->stockCategory != null) {
            # code...
            $name_text = $name_text.' - '. $this->stockCategory->name;
        }
        return $name_text;
    }
}
