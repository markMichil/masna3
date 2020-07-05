<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
	
    protected $table = 'invoices';
    protected $fillable = ['factories_id','paid','remains','total_price','type_buy','done'];
}
