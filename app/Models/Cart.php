<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
		'user_id', 
		'store_id', 
		'transpot_service_id', 
		'transpot_variation_id', 
		'transpot_price_default', 
		'transpot_price_fast',
		'transpot_type',
		'accept_checkout'
	];
	public function products(){
        return $this->belongsToMany(Product::class, 'cart_item', 'product_id', 'cart_id');

        // return $this->hasOne(ProductVariation::class, 'product_id', 'id');
    }

	function store(){
        return $this->hasOne(Store::class, 'id', 'store_id');

    }

	function cart_item(){
		return $this->hasMany(CartItem::class, 'cart_id', 'id');
	}

	function transpot_service(){
		return $this->belongsTo(TranspotService::class, 'transpot_service_id', 'id');
	}


}
