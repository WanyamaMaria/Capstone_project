<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $primaryKey = 'participantId'; // Custom primary key
    protected $fillable = [
        'fullName',
        'email',
        'affiliation',
        'specialization',
        'crossSkillTrained',
        'institution',
        'project_id',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}