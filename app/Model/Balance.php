<?php

namespace App\Model;

class Balance extends \Eloquent
{

    protected $table = 'balance';

    protected $fillable = [
        'amount',
        'concept',
        'date'
    ];

    public $timestamps = false;

}
