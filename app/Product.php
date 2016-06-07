<?php

namespace App;

use Keyhunter\Administrator\Repository;

class Product extends Repository
{
    protected $fillable = [
        'name', 'price', 'sale', 'count', 'type', 'status', 'published_date', 'expiration_date'
    ];
}