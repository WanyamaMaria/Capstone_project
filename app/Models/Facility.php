<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','location','description',
        'partner_organization','facility_type','capabilities'
    ];

    public function services() { return $this->hasMany(Service::class); }
    public function equipment() { return $this->hasMany(Equipment::class); }
    public function projects() { return $this->hasMany(Project::class); }
}
