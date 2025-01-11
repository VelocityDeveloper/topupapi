<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $fillable = [
        'brand_name',
        'brand_description',
        'brand_logo',
    ];
}
