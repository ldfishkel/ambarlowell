<?php

namespace App\Model;

class Debt extends \Eloquent
{

    protected $table = 'debts';

    protected $fillable = [
		'client_id',
        'sale_id',
        'amount',
        'payed',
        'concept',
        'date',
    ];

    public $timestamps = false;

}

