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
        Schema::create('user_projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->string('project_name');
            $table->string('project_detail');
            $table->date('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_projects');
    }
};
