<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_name',
        'category',
        'brand',
        'type',
        'seller_name',
        'price',
        'buyer_sku_code',
        'buyer_product_status',
        'seller_product_status',
        'unlimited_stock',
        'stock',
        'multi',
        'start_cut_off',
        'end_cut_off',
        'desc',
        'status'
    ];

    public static function save_product(array $data = [])
    {
        $product = Product::updateOrCreate(
            ['buyer_sku_code' => $data['buyer_sku_code']],
            array_merge($data, ['status' => 1])
        );
        //update ke category
        $category = ProductCategory::updateOrCreate(
            ['category_name' => $data['category']]
        );
        //update ke brand
        $brand = ProductBrand::updateOrCreate(
            ['brand_name' => $data['brand']]
        );
        //update ke type
        $type = ProductType::updateOrCreate(
            ['type_name' => $data['type']]
        );

        return $product;
    }

    public static function save_datas(array $datas = [])
    {
        $results = [];

        //reset status ke 0
        Product::where('status', 1)->update(['status' => 0]);

        //simpan data
        foreach ($datas['data'] as $data) {
            $results[] = self::save_product($data);
        }

        return $results;
    }


    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category');
    }

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand');
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type');
    }
}
