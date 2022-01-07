<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function geographicrestriction(){
        return $this->hasMany('App\Models\GeographicRestriction');
    }

    public function gamewishlist(){
        return $this->hasMany('App\Models\GameWishList');
    }

    public function valuation(){
        return $this->hasMany('App\Models\Valuation');
    }

    public function library(){
        return $this->hasMany('App\Models\Library');
    }

    public function agerestriction(){
        return $this->belongsTo('App\Models\AgeRestriction');
    }

    public function gamegenre(){
        return $this->hasMany('App\Models\GameGenre');
    }

    public function gametransaction(){
        return $this->hasMany('App\Models\GameTransaction');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
