<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    // Use equipmentId as the primary key
    protected $primaryKey = 'equipmentId';
    public $incrementing = false;
    protected $keyType = 'string';

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
        return $this->belongsTo(Facility::class, 'facility_id', 'facility_id');
    }

    protected static function booted()
    {
        static::creating(function ($equipment) {
            // Enforce facility linkage
            if (!$equipment->facility_id) {
                throw new \Exception('Equipment must be assigned to a facility.');
            }

            // Auto-generate equipmentId if missing
            if (!$equipment->equipmentId) {
                $lastItem = Equipment::withTrashed()
                    ->orderByDesc('equipmentId')
                    ->first();

                $newNumber = $lastItem
                    ? intval(substr($lastItem->equipmentId, 4)) + 1
                    : 1;

                $equipment->equipmentId = 'EQP-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
