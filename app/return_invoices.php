<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class return_invoices extends Model
{
    //
    protected $table = 'return_invoices';

    public function factory(){
        return  $this->belongsTo('App\factory','factories_id','id');
    }

    public function return_invoice_details()
    {
        return $this->hasMany('App\return_invoice_details','return_invoices_id','id');
    }


}



