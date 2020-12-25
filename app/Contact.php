<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contacts";
    public function numbers(){
        return $this->hasMany(Number::class);
    }
}
