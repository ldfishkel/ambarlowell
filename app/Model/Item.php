<?php

namespace App\Model;

class Item extends \Eloquent
{

    protected $table = 'order_item';

    protected $fillable = [
        'product_id', 
        'order_id', 
        'amount',
        'unit_price',
    ];

    public $timestamps = false;

}
