<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $table = 'product_variations';
    protected $guarded =[];
    protected $fillable = [
        'product_id',
        'name',
        'sku'
    ];
    public function product_price_details(){
        return $this->hasMany(ProductPriceDetail::class, 'product_variation_id', 'id');
    }
    public function product_price_detail(){
        return $this->hasOne(ProductPriceDetail::class, 'product_variation_id', 'id');
    }

    public function carts(){
        return $this->hasMany(Cart::class, 'variation_id', 'id');
    }
}
