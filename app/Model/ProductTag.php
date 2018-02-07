<?php

namespace App\Model;

class ProductTag extends \Eloquent
{

    protected $table = 'product_tag';

    protected $fillable = [
        'product_id',
        'tag_id',
    ];

    public $timestamps = false;

}
