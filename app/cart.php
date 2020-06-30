<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'carts';

    public function factory(){
        return  $this->belongsTo('App\factory','factories_id','id');
    }

    public function product(){
        return  $this->belongsTo('App\product','products_id','id');
    }
}
