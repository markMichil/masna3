<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class return_invoice_details extends Model
{
    protected $table = 'return_invoice_details';

    public function return_invoices(){
        return  $this->belongsTo('App\return_invoices','return_invoices_id','id');
    }
    public function product(){
        return  $this->belongsTo('App\product','products_id','id');
    }
}
