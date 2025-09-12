<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
 use HasFactory, SoftDeletes;
    protected $primaryKey = 'service_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'service_id',
        'facility_id',
        'name',
        'description',
        'category',
        'skill_type',
    ];



    // Service belongs to a Facility
    public function facility()
    {
        return $this->belongsTo(Facility::class , 'facility_id', 'facility_id');
    } //
}
