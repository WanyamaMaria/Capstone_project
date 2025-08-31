<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'capabilities',
        'inventoryCode',
        'usageDomain',
        'supportPhase',
        'facility_id'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
