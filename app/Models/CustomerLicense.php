<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerLicense extends Model
{
    protected $fillable = [
        'customer_id',
        'secret_key',
        'active',
        'expiry_date'
    ];

    // Relasi satu ke satu dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
