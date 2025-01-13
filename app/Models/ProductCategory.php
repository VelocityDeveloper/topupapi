<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'category_name',
        'category_description',
    ];

    protected $appends = ['logo_url'];

    //attribute logo url
    public function getLogoUrlAttribute()
    {
        if (!$this->category_logo) {
            return null;
        }
        return asset('storage/' . $this->category_logo);
    }
}
