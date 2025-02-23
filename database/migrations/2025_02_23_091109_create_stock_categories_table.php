<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('image')->nullable();
            $table->bigInteger('buying_price')->nullable()->default(0);
            $table->bigInteger('selling_price')->nullable()->default(0);
            $table->bigInteger('expected_price')->nullable()->default(0);
            $table->bigInteger('earned_price')->nullable()->default(0);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_categories');
    }
};
