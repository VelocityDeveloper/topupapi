<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'secret_code',
        'secret_key',
        'domain',
        'email',
        'name',
        'telepon',
        'status',
    ];

    //boot
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            //buat juga data di table customer_licenses
            $lastID = self::max('id');
            // CustomerLicense::create([
            //     'customer_id' => $model->id,
            //     'secret_code' => Str::random(10),
            //     'secret_key' => Str::uuid()
            // ]);
        });
    }
}
