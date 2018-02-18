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
        'image',
    ];

    public $timestamps = false;

    public function totalStock() {
        return Stock::where('product_id', $this->id)->sum('current');
    }

}
