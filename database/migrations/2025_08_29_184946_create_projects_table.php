<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            // Custom primary key
            $table->string('projectId')->primary();

            // Foreign keys referencing custom IDs
            $table->string('facility_id');
            $table->foreign('facility_id')
                  ->references('facilityId')
                  ->on('facilities')
                  ->onDelete('cascade');

            $table->string('program_id');
            $table->foreign('program_id')
                  ->references('programId')
                  ->on('programs')
                  ->onDelete('cascade');

            // Project fields
            $table->string('title');
            $table->text('project_overview')->nullable();
            $table->string('nature_of_project');
            $table->string('innovation_focus')->nullable();
            $table->string('prototype_stage');
            $table->text('testing_requirements')->nullable();
            $table->text('commercialization_plan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
