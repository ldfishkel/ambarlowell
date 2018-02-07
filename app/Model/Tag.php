<?php

namespace App\Model;

class Tag extends \Eloquent
{

    protected $table = 'tags';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

}
