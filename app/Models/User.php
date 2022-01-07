<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory; 

    public function wishlist(){
        return $this->hasOne('App\Models\WishList');
    }

    public function valuation(){
        return $this->hasMany('App\Models\Valuation');
    }

    public function library(){
        return $this->hasMany('App\Models\Library');
    }

    public function country(){
        return $this->belongsTo('App\Models\Country');
    }

    public function followup1(){
        return $this->hasMany('App\Models\FollowUp');
    }

    public function followup2(){
        return $this->hasMany('App\Models\FollowUp');
    }

    public function userpaymentmethod(){
        return $this->hasMany('App\Models\UserPaymentMethod');
    }
    
    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    public function usercoin(){
        return $this->hasMany('App\Models\UserCoin');
    }

    public function transaction(){
        return $this->hasMany('App\Models\Transaction');
    }
}
