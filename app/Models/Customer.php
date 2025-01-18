<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'domain',
        'email',
        'name',
        'telepon',
        'status',
    ];

    public static function add_new($request)
    {
        $customer = Customer::create([
            'domain'    => $request['domain'],
            'email'     => $request['email'],
            'name'      => $request['name'],
            'telepon'   => $request['telepon'],
            'status'    => $request['status'],
        ]);

        $customer->license()->create([
            'secret_key' => Str::uuid(),
            'active' => true
        ]);

        return $customer;
    }

    // Relasi satu ke satu dengan CustomerLicense
    public function license()
    {
        return $this->hasOne(CustomerLicense::class, 'customer_id');
    }

    public static function generate_key($id)
    {
        $customer = Customer::with('license:customer_id,secret_key')->select('id', 'customer_code')->find($id);
        if ($customer->license->secret_key) {
            //generate ulang key
            $customer->license()->update(['secret_key' => Str::uuid()]);
        }
        return response()->json($customer);
    }

    //boot
    public static function boot()
    {
        parent::boot();
        self::creating(function ($customer) {
            if (empty($customer->customer_code)) {
                $lastID = self::max('id');
                $customer->customer_code = fake()->regexify('[A-Z]{2}') . ($lastID + 1000);
            }
        });
    }
}
