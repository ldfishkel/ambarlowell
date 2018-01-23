<?php

namespace App\Models;

class Stock extends \Eloquent
{

    protected $table = 'stock';

    protected $fillable = [
        'product_id',
        'initial',
        'current',
        'entrance',
        'settlement'
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
