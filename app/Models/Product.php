<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'products';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = [
        'title',
        'slug',
        'sku',
        'category_id',
        'brand_id',
        'product_type_id',
        'is_variation',
        'is_ecard',
        'status',
    ];

  
 
    public function product_detail() {
        return $this->hasOne(ProductDetail::class, 'product_id', 'id');
    }

    public function product_relateds(){
        return $this->hasMany(ProductRelated::class, 'product_id', 'id');
    }
    public function product_price() {
        return $this->hasOne(ProductPrice::class, 'product_id', 'id');
    }

    public function product_payment() {
        return $this->hasMany(ProductPayment::class, 'product_id', 'id');
    }

    public function product_variations(){
        return $this->hasMany(ProductVariation::class, 'product_id', 'id');
    }

    public function product_variation(){
        return $this->belongsToMany(ProductVariation::class, 'cart', 'product_id', 'variation_id');

        // return $this->hasOne(ProductVariation::class, 'product_id', 'id');
    }


    public function product_brand() {
        return $this->belongsto(ProductBrand::class, 'brand_id', 'id');
    }

    public function product_category() {
        return $this->belongsto(ProductCategory::class, 'category_id', 'id');
    }

    public function product_type(){
        return $this->belongsto(ProductType::class, 'product_type_id', 'id');
    }

    public function store_product(){
        return $this->hasMany(StoreProduct::class, 'product_id', 'id');

    }


    public function stores(){
    	return $this->belongsToMany(Store::class, 'store_product', 'product_id', 'store_id')->withPivot(['quantity']);
    }
    public function store_products(){
        return $this->hasMany(ProductStore::class, 'id_ofproduct', 'id');

    }


    public function order_products(){
        return $this->hasMany(orderProduct::class, 'id_product', 'id');
    }




}