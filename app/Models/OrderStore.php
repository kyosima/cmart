<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderStore
 * 
 *
 * @package App\Models
 */
class OrderStore extends Model
{
	protected $table = 'order_stores';

	protected $casts = [
		'id_order' => 'int'
	];

	protected $fillable = [
		'id_order',
		'id_store',
		'shipping_code',
		'shipping_total',
		'vat_products',
		'vat_services',
		'discount_products',
		'discount_services',
		'shipping_method',
		'remaining_m_point',
		'tax',
		'c_point',
		'm_point',
		'sub_total',
		'total'
	];


	public function order_products(){
		return $this->hasMany(OrderProduct::class, 'id_order_store');
	}

	public function store(){
		return $this->belongsTo(Store::class,  'id_store', 'id');
	}
}
