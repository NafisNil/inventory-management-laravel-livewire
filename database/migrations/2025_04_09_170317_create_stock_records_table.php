<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
use App\Models\StockCategory;
use App\Models\StockSubCategory;
use App\Models\StockItem;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_records', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class);
            $table->foreignIdFor(StockCategory::class)->nullable();
            $table->foreignIdFor(StockSubCategory::class)->nullable();
            $table->foreignIdFor(StockItem::class)->nullable();
            $table->foreignIdFor(User::class, 'created_by_id')->nullable();
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->string('quantity')->nullable();
            $table->string('measuring_unit');
            $table->string('selling_price');
            $table->string('total_sales');
            $table->text('description')->nullable();
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_records');
    }
};
