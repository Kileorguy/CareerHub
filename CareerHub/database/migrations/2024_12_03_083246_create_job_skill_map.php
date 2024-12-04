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
        Schema::create('job_skill_maps', function (Blueprint $table) {
            $table->uuid('company_job_id');
            $table->uuid('job_skill_id');

            $table->primary(['company_job_id', 'job_skill_id']);

            $table->foreign('company_job_id')->references('id')->on('company_jobs')->onDelete('cascade');
            $table->foreign('job_skill_id')->references('id')->on('job_skills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_skill_map');
    }
};
