<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleFunctionality extends Model
{
    use HasFactory;

    public function functionality(){
        return $this->belongsTo('App\Models\Functionality');
    }

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }
}