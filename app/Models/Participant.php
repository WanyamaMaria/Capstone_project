<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'participant_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'participant_id',
        'full_name',
        'email',
        'affiliation',
        'specialization',
        'cross_skill_trained',
        'institution',
    ];

    // Many-to-many relationship
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_participants', 'participant_id', 'project_id');
    }
}
