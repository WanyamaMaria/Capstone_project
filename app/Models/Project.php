<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function outcomes()
    {
        return $this->hasMany(Outcome::class);
    }
}
