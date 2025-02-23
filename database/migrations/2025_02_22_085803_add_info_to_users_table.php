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
        Schema::table('admin_users', function (Blueprint $table) {
            //
            $table->integer('company_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_number_2')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('address')->nullable();
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_users', function (Blueprint $table) {
            //
        });
    }
};
