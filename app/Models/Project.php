<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'projectId'; // ✅ Custom primary key
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'projectId',
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

    // Relationships
    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_id'); // ✅ Explicit FK mapping
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id'); // ✅ Matches corrected migration
    }

    public function outcomes()
    {
        return $this->hasMany(Outcome::class, 'project_id', 'projectId'); // ✅ Explicit mapping
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'project_id', 'projectId'); // ✅ Explicit mapping
    }
}
