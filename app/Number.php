<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    protected $table = 'numbers';
    public function contact(){
        return $this->belongsTo(Contact::class);
    }
}
