<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    protected $table = 'store';
    public function store_public()
    {
        $this->hasMany('App\Models\Service\publics','public_id','id')->where('public_type',1)->select('public_picture');
    }
}
