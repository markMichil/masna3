<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';

    public function factory(){
     return  $this->belongsTo('App\factory','factories_id','id');
    }

    public function return_invoice_details()
    {
        return $this->hasMany('App\return_invoice_details','products_id','id');
    }
    public function cart_return_invoices()
    {
        return $this->hasMany('App\cart_return_invoices','products_id','id');
    }
}
