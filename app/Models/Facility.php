<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use HasFactory, SoftDeletes;

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
        return $this->hasMany(Service::class);
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }



protected static function booted()
{
    static::created(function ($facility) {
        if (!$facility->facility_id) {
            $facility->facility_id = 'FAC-' . str_pad($facility->id, 4, '0', STR_PAD_LEFT);
            $facility->saveQuietly(); // prevents recursion
        }
    });
}

}
