<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'type_name',
        'type_description',
    ];

    protected $appends = ['logo_url'];

    //attribute logo url
    public function getLogoUrlAttribute()
    {
        if (!$this->type_logo) {
            return null;
        }
        return asset('storage/' . $this->type_logo);
    }
}
