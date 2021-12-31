<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    use HasFactory;

    public function paymentmethod(){
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}