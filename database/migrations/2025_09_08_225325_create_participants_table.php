<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id('participantId'); // Custom primary key
            $table->string('fullName');
            $table->string('email')->unique();
            $table->string('affiliation'); // CS, SE, Engineering, etc.
            $table->string('specialization'); // Software, hardware, business
            $table->boolean('crossSkillTrained')->default(false);
            $table->string('institution'); // SCIT, CEDAT, UniPod, etc.
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete(); // No cascade
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
