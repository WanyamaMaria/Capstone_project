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
        return $this->belongsTo(Facility::class);
    }

    protected static function booted()
    {
        static::creating(function ($equipment) {
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
