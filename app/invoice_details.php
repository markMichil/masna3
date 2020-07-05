<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice_details extends Model
{
    protected $table ='invoice_details';

    protected $fillable =['invoices_id','products_id','quantity','price','sell','sell_D','price_D'];
}
