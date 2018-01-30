<?php

namespace App\Model;

class Credit extends \Eloquent
{

    protected $table = 'credits';

    protected $fillable = [
        'supplier_id',
        'cost_id',
        'amount',
        'payed',
        'date'
    ];

    public $timestamps = false;

}
