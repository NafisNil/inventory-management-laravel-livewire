<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
use App\Models\StockCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Company::class)->nullable();
            $table->foreignIdFor(StockCategory::class)->nullable();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('image')->nullable();
            $table->bigInteger('buying_price')->nullable()->default(0);
            $table->bigInteger('selling_price')->nullable()->default(0);
            $table->bigInteger('expected_price')->nullable()->default(0);
            $table->bigInteger('earned_price')->nullable()->default(0);
            $table->string('measurement_unit');
            $table->bigInteger('current_quantity')->nullable()->default(0);
            $table->bigInteger('reorder_level')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_sub_categories');
    }
};
