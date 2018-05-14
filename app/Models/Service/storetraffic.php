<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class storeTraffic extends Model
{
    //
    protected $table = 'store_traffic';
    public function store_traffic()
    {
        $this->hasMany('App\Models\Service\storeTraffic','store_id','id');
    }
}
