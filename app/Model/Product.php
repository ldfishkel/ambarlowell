<?php

namespace App\Models;

class Product extends \Eloquent
{

    protected $table = 'products';

    protected $fillable = [
        'model', 
        'description', 
        'fabricated', 
        'cost',
        'wholesale',
        'retail',
    ];

    public $timestamps = false;

}
