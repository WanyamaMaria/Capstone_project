<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->string('project_id')->primary();
            $table->string('facility_id');
            $table->foreign('facility_id')->references('facility_id')->on('facilities')->onDelete('cascade');
            $table->string('program_id');
            $table->foreign('program_id')->references('program_id')->on('programs')->onDelete('cascade');
           
            $table->text('description')->nullable();
           


            // Foreign key to facilities
          
            // Project fields
            $table->string('title');
            $table->text('project_overview')->nullable();
            $table->string('nature_of_project');
            $table->string('innovation_focus')->nullable();
            $table->string('prototype_stage');
            $table->text('testing_requirements')->nullable();
            $table->text('commercialization_plan')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
