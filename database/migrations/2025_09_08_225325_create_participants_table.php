<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->string('participant_id')->primary();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('affiliation');
            $table->string('specialization');
            $table->boolean('cross_skill_trained')->default(false);
            $table->string('institution');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
