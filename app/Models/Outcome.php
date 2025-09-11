<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outcome extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'outcome_id';
    public $incrementing = false;
    protected $keyType = 'string';

  

    protected $fillable = [
        'OutcomeId',
        'ProjectId',
        'Title',
        'Description',
        'ArtifactLink',
        'OutcomeType',
        'QualityCertification',
        'CommercializationStatus',
    ];

    // Relationship to Project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }
}
