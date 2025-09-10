<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $primaryKey = 'participantId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'participantId',
        'fullName',
        'email',
        'affiliation',
        'specialization',
        'crossSkillTrained',
        'institution',
        'project_id',
    ];

    public function getRouteKeyName()
    {
        return 'participantId';
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'projectId');
    }

}
