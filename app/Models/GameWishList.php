<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameWishList extends Model
{
    use HasFactory;

    public function wishlist(){
        return $this->belongsTo('App\Models\WishList');
    }

    public function game(){
        return $this->belongsTo('App\Models\Game');
    }
}
