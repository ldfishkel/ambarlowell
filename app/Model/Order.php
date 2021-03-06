<?php

namespace App\Model;

class Order extends \Eloquent
{
    protected $table = 'orders';

    protected $fillable = [
        'client_id', 
        'type',
        'status',
        'date',
        'fabricator',
        'channel',
    ];

    public $timestamps = false;

    public function Client() {
        return $this->belongsTo(Clients::class);
    }
}
