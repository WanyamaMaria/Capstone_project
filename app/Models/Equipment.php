<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'equipmentId',
        'facility_id',
        'name',
        'capabilities',
        'description',
        'inventoryCode',
        'usageDomain',
        'supportPhase',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    protected static function booted()
    {
        static::created(function ($equipment) {
            if (!$equipment->equipmentId) {
                $equipment->equipmentId = 'EQP-' . str_pad($equipment->id, 4, '0', STR_PAD_LEFT);
                $equipment->saveQuietly();
            }
        });
    }
}
