<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameTransaction extends Model
{
    use HasFactory;

    public function transaction(){
        return $this->belongsTo('App\Models\Transaction');
    }

    public function game(){
        return $this->belongsTo('App\Models\Game');
    }
}
