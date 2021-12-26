<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function Product()
    {
        return $this->belongsTo('App\Product');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
