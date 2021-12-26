<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function Division()
    {
        return $this->belongsTo('App\Division');
    }
}
