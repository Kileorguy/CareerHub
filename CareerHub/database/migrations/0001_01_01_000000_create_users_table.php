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
    Schema::create('users', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('email')->unique();
      $table->string('password');
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();
      $table->text('short_description')->nullable();
      $table->string('github_link')->nullable();
      $table->string('portfolio_link')->nullable();
      $table->string('role')->nullable();
      $table->string('profile_link')->nullable();
    });

    // Schema::create('password_reset_tokens', function (Blueprint $table) {
    //     $table->string('email')->primary();
    //     $table->string('token');
    //     $table->timestamp('created_at')->nullable();
    // });

    Schema::create('sessions', function (Blueprint $table) {
      $table->uuid('id')->primary();
      //            $table->uuid('id');
      $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
      $table->string('ip_address', 45)->nullable();
      $table->text('user_agent')->nullable();
      $table->longText('payload');
      $table->integer('last_activity')->index();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('sessions');
    Schema::dropIfExists('users');
    // Schema::dropIfExists('password_reset_tokens');
  }
};
