<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'description',
        'facility_id',
    ];

    // Service belongs to a Facility
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    } //
}
