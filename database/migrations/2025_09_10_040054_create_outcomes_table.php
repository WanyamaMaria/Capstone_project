<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->string('outcome_id')->primary();           // Unique identifier
            $table->string('project_id');                      // FK to projects
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('artifact_link')->nullable();
            $table->string('outcome_type')->nullable();       // CAD, PCB, Prototype, etc.
            $table->string('quality_certification')->nullable();
            $table->string('commercialization_status')->nullable(); // Demoed, Market Linked, Launched
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_id')
                  ->references('project_id')
                  ->on('projects')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outcomes');
    }
};
