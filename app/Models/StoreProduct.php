<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class StoreProduct extends Model
{
	protected $table = 'store_product';

	protected $casts = [
	];

	protected $fillable = [
		'store_id',
		'product_id',
		'quantity',
	];
	
	function storeproduct_userlevels(){
        return $this->hasMany(StoreproductUserlevel::class, 'storeproduct_id', 'id');
    }

	function product(){
		return $this->hasOne(Product::class, 'id', 'product_id');
	}
	function store(){
        return $this->hasOne(Store::class, 'id', 'store_id');

    }
}
