<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
    ];

    protected $primaryKey = 'id';
    protected $incrementing = true;
    protected $keytype = 'int';
    protected $timestamps = false;
}
