<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functionality extends Model
{
    use HasFactory;

    public function rolefunctionality(){
        return $this->hasMany('App\Models\RoleFunctionality');
    }
}
