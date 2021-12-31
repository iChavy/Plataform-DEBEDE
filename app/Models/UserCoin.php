<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoin extends Model
{
    use HasFactory;

    public function coinpack(){
        return $this->belongsTo('App\Models\CoinPack');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}