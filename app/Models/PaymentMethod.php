<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public function bankmethod(){
        return $this->hasMany('App\Models\BankMethod');
    }

    public function userpaymentmethod(){
        return $this->hasMany('App\Models\UserPaymentMethod');
    }
}
