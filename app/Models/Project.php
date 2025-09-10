<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'project_overview',
        'nature_of_project',
        'innovation_focus',
        'prototype_stage',
        'testing_requirements',
        'commercialization_plan',
        'facility_id',
        'program_id',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function outcomes()
    {
        return $this->hasMany(Outcome::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
