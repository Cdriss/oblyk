<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lexique extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

}