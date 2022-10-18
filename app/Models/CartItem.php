<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_item';

    protected $fillable = [
		'cart_id',
		'product_id',
		'variation_id',
		'quantity',
		'price',
		'is_ecard',
		'store_product_id'
	];


	function product(){
		return $this->hasOne(Product::class, 'id', 'product_id');
	}
	
	function cart(){
		return $this->hasOne(Cart::class, 'id', 'cart_id');
	}

	function store(){
        return $this->hasOneThrough(Store::class, Cart::class, 'id','id', 'cart_id', 'store_id');

    }
	function variation(){
        return $this->hasOne(ProductVariation::class, 'id', 'variation_id');

    }
}
