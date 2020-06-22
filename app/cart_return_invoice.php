<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart_return_invoice extends Model
{
    protected $table = 'cart_return_invoices';

    public function factory(){
        return  $this->belongsTo('App\factory','factories_id','id');
    }

    public function product(){
        return  $this->belongsTo('App\product','products_id','id');
    }
}
