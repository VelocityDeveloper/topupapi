<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'ref_id',
        'customer_id',
        'customer_no',
        'product_id',
        'buyer_sku_code',
        'message',
        'status',
        'price',
        'testing',
    ];

    // Relasi satu ke satu dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relasi satu ke satu dengan Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public static function boot()
    {
        parent::boot();

        // Event ketika data dibuat
        self::creating(function ($transaction) {
            if (empty($transaction->ref_id)) {
                $transaction->ref_id = date('ymdH') . Str::upper(Str::random(6));
            }
            //jika ada customer, kurangi saldo
            if ($transaction->customer_id) {
            }
        });
    }
}
