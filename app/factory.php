<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factory extends Model
{

	    protected $table = 'factories';
        protected $fillable = [
        'name', 'phone', 'address',
    ];

}
