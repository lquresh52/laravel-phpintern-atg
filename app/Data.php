<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    //
    protected $table = 'data';
    // public $timestamps = false;

    protected $fillable = [
        'user_name',
        'gmail_id',
        'pincode',
    ];
}
