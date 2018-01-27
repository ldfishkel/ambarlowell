<?php

namespace App\Model;

class Sale extends \Eloquent
{

    protected $table = 'sales';

    protected $fillable = [
        'order_id',
        'payment_type',
        'sale_type',
        'amount',
        'date',
    ];

    public $timestamps = false;

}
