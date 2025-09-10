<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->string('OutcomeId')->primary(); // Custom string-based PK

            $table->string('ProjectId'); // FK to projects.projectId
            $table->foreign('ProjectId')
                  ->references('projectId')
                  ->on('projects')
                  ->onDelete('cascade');

            $table->string('Title');
            $table->text('Description')->nullable();
            $table->string('ArtifactLink')->nullable();
            $table->string('OutcomeType');
            $table->string('QualityCertification')->nullable();
            $table->string('CommercializationStatus')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outcomes');
    }
};
