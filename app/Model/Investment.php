<?php

namespace App\Model;

class Investment extends \Eloquent
{

    protected $table = 'investments';

    protected $fillable = [
        'investor',
        'amount',
    ];

    public $timestamps = false;

}
