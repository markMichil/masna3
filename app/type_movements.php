<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_movements extends Model
{
    protected $table = 'type_movements';


    public function movements()
    {
        return $this->hasMany('App\movements','type_movements_id','id');
    }
}
