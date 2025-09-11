<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'participant_id'; // snake_case
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'fullName',
        'email',
        'affiliation',
        'specialization',
        'crossSkillTrained',
        'institution',
        'project_id',
        'participantId',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}