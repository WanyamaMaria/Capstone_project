<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->string('participantId')->primary(); // ✅ Custom string-based PK

            $table->string('fullName');
            $table->string('email')->unique();
            $table->string('affiliation'); // CS, SE, Engineering, etc.
            $table->string('specialization'); // Software, hardware, business
            $table->boolean('crossSkillTrained')->default(false);
            $table->string('institution'); // SCIT, CEDAT, UniPod, etc.

            // ✅ Explicit foreign key to projects.projectId
            $table->string('project_id')->nullable();
            $table->foreign('project_id')
                  ->references('projectId')
                  ->on('projects')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
