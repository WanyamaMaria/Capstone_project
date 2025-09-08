<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'description',
        'facility_id',
        'program_id',
    ];

    // Project belongs to a Facility
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    // Project belongs to a Program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    // Project has many Outcomes 
    public function outcomes()
    {
        return $this->hasMany(Outcome::class);
    }
}
