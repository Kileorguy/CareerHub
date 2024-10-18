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
        Schema::create('user_education', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->string('education_name');
            $table->string('major');
            $table->float('gpa')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_education');
    }
};
