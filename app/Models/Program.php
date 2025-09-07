<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
      use HasFactory,SoftDeletes;
    protected $primaryKey = 'program_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
    'name',
    'program_id',
    'description',
    'national_alignment',
    'focus_areas',
    'phases',
];



    public function projects() { return $this->hasMany(Project::class); }
}
