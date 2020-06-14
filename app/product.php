<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';

    public function factory(){
     return  $this->belongsTo('App\factory','factories_id','id');
    }
}
