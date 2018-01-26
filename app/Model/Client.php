<?php

namespace App\Model;

class Client extends \Eloquent
{

    protected $table = 'clients';

    protected $fillable = [
        'name', 
        'phone', 
        'instagram', 
        'facebook',
        'address',
        'email',
    ];

    public $timestamps = false;

}
