<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
use App\Models\FinancialPeriod;
use App\Models\StockCategory;
use App\Models\User;
use App\Models\StockSubCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class);
            $table->foreignIdFor(User::class, 'created_by_id');
            $table->foreignIdFor(FinancialPeriod::class);
            $table->foreignIdFor(StockCategory::class);
            $table->foreignIdFor(StockSubCategory::class);
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('generate_sku')->nullable();
            $table->string('update_sku')->nullable();
            $table->string('weight_unit')->nullable();
            $table->string('gallery')->nullable();
            $table->bigInteger('buying_price')->default(0);
            $table->bigInteger('selling_price')->default(0);
            $table->bigInteger('original_price')->default(0);
            $table->bigInteger('current_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
