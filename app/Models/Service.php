<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
 use HasFactory, SoftDeletes;
    protected $primaryKey = 'ServiceId';
    public $incrementing = false;
    protected $keyType = 'string';

    


    protected $fillable = [
        'service_id',
        'facility_id',
        'Name',
        'Description',
        'Category',
        'SkillType',
    ];



    // Service belongs to a Facility
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    } //
}
