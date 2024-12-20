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
    Schema::create('jobs', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('company_id');
      $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
      $table->string('job_name');
      $table->text('job_description');
      $table->string('job_level');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('jobs');
  }
};
