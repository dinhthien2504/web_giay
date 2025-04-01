<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $primaryKey = 'id';
    protected $incrementing = true;
    protected $keytype = 'int';
    protected $timestamps = false;
}
