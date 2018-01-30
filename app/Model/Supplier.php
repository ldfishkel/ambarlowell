<?php

namespace App\Model;

class Supplier extends \Eloquent
{

    protected $table = 'suppliers';

    protected $fillable = [
        'info',
    ];

    public $timestamps = false;

}
