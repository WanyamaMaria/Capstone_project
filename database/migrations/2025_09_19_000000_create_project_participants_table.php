<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('project_participants', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('participant_id');
            $table->timestamps();

            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
            $table->foreign('participant_id')->references('participant_id')->on('participants')->onDelete('cascade');
            $table->unique(['project_id', 'participant_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_participants');
    }
}
