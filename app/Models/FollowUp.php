<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    public function user1(){
        return $this->belongsTo('App\Models\User');
    }

    public function user2(){
        return $this->belongsTo('App\Models\User');
    }
}
