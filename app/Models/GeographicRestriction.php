<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeographicRestriction extends Model
{
    use HasFactory;

    public function country(){
        return $this->belongsTo('App\Models\Country');
    }

    public function game(){
        return $this->belongsTo('App\Models\Game');
    }
}
