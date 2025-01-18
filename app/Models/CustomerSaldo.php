<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSaldo extends Model
{

    protected $fillable = [
        'customer_id',
        'nominal',
    ];

    // Relasi satu ke satu dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
