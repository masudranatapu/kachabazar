<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    //
    protected $fillable = [
        'image',
        'title',
        'details',
        'slug',
        'status',
    ];
}
