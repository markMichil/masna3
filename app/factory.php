<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factory extends Model
{

	    protected $table = 'factories';
        protected $fillable = [
        'name', 'phone', 'address',
    ];

    public function product()
    {
        return $this->hasMany('App\product');
    }
    public function return_invoices()
    {
        return $this->hasMany('App\return_invoices','factories_id','id');
    }

    public function cart_return_invoices()
    {
        return $this->hasMany('App\cart_return_invoices','factories_id','id');
    }
}
