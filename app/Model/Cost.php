<?php

namespace App\Model;

class Cost extends \Eloquent
{

    protected $table = 'costs';

    protected $fillable = [
        'supplier_id',
        'amount',
        'concept',
        'payment_type',
        'date'
    ];

    public $timestamps = false;

}
