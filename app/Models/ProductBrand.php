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

    protected $appends = ['logo_url'];

    //attribute logo url
    public function getLogoUrlAttribute()
    {
        if (!$this->brand_logo) {
            return null;
        }
        return asset('storage/' . $this->brand_logo);
    }
}
