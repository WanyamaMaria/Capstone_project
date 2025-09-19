<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'project_id';
    public $incrementing = false;   // since project_id is a string
    protected $keyType = 'string';

    protected $fillable = [
        'project_id',
        'facility_id',
        'program_id',
        'title',
        'description',
        'project_overview',
        'nature_of_project',
        'innovation_focus',
        'prototype_stage',
        'testing_requirements',
        'commercialization_plan',
    ];

    // 👇 Add this relationship
    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_id');
    }

    // Also add program relationship if needed
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    // Projects have many participants via the pivot table
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'project_participants', 'project_id', 'participant_id');
    }
}
