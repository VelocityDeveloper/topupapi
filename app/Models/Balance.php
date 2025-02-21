<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balance extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'flow',
        'customer_id',
        'nominal',
        'transaction_id',
        'description',
        'date',
    ];

    // Relasi satu ke satu dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relasi satu ke satu dengan Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    // boot
    public static function boot()
    {
        parent::boot();

        // Event ketika data dibuat
        self::creating(function ($model) {
            if (empty($balance->date)) {
                $model->date = date('Y-m-d H:i:s');
            }
        });
    }
}
