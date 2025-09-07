<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->unsigned(); // Foreign key, SQLite-compatible
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('artifact_link')->nullable();
            $table->string('outcome_type');
            $table->string('quality_certification')->nullable();
            $table->string('commercialization_status')->nullable();
            $table->timestamps();

            // SQLite doesn't enforce foreign keys by default; add manually if needed
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outcomes');
    }
};
