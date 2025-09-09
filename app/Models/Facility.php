<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'facility_id'; // Custom primary key
    public $incrementing = false; // Non-incrementing primary key
    protected $keyType = 'string'; // Primary key is a string

    protected $fillable = [
        'name',
        'location',
        'facility_id',
        'description',
        'partnerOrganization',
        'facilityType',
        'capabilities',
    ];

    // Relationships
    public function services()
    {
        return $this->hasMany(Service::class, 'facility_id', 'facility_id');
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class, 'facility_id', 'facility_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'facility_id', 'facility_id');
    }
}
