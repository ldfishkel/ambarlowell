<?php

namespace App\Model;

class Requested extends \Eloquent
{

    protected $table = 'requested';

    protected $fillable = [
		'product_id',
        'amount',
    ];

    public $timestamps = false;

}