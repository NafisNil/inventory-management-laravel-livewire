<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();

            $table->string('name');
            $table->string('email')->nullable();
            $table->text('logo')->nullable();
            $table->string('website')->nullable();
           $table->text('about')->nullable();
           $table->string('status')->nullable();
           $table->date('licensed_expire')->nullable();
           $table->text('address')->nullable();
           $table->string('phone_number')->nullable();
           $table->string('phone_number2')->nullable();
           $table->string('color')->nullable();
           $table->string('slogan')->nullable();
           $table->string('facebook')->nullable();
           $table->string('twitter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
