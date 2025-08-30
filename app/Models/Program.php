<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
      use HasFactory;

    protected $fillable = [
    'name',
    'description',
    'national_alignment',
    'focus_areas',
    'phases',
];



    public function projects() { return $this->hasMany(Project::class); }
}
