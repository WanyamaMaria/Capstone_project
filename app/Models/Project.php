<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ✅ import SoftDeletes

class Project extends Model
{
    use HasFactory, SoftDeletes; // ✅ add SoftDeletes here

    protected $primaryKey = 'project_id';
    public $incrementing = false;
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

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'project_participants', 'project_id', 'participant_id');
    }
}
