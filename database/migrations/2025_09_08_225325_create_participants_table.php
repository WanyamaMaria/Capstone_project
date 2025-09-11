<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->string('participant_d')->primary; // Custom primary key
            $table->string('project_id');

            $table->string('fullName');
            $table->string('email')->unique();
            $table->string('affiliation'); // CS, SE, Engineering, etc.
            $table->string('specialization'); // Software, hardware, business
            $table->boolean('crossSkillTrained')->default(false);
            $table->string('institution'); // SCIT, CEDAT, UniPod, etc.
            // $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->foreign('project_id')
                    ->references('project_id') // <-- match projects PK
                    ->on('projects')
                    ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes(); // Soft deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
