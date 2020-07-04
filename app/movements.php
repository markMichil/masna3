<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movements extends Model
{
    //
    protected $table = 'movements';

    public function type_movements(){
        return  $this->belongsTo('App\type_movements','type_movements_id','id');
    }
    public function product(){
        return  $this->belongsTo('App\product','products_id','id');
    }
}
