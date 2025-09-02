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
        'description',
        'facility_id',
        'partnerOrganization',
        'facilityType',
        'capabilities',
    ];

    // protected $casts = [
    //     'capabilities' => 'array',
    // ];




    protected static function boot()
{
    parent::boot();

    static::creating(function ($facility) {
        // Generate next number based on last facility_id
        $lastFacility = Facility::orderBy('id', 'desc')->first();
        $nextNumber = $lastFacility ? ((int) str_replace('FAC-', '', $lastFacility->facility_id)) + 1 : 1;

        $facility->facility_id = 'FAC-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    });
}

}
