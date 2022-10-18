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
		'order_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'store_id',
		'order_store_code',
		'shipping_code',
		'shipping_total',
		'vat_products',
		'vat_services',
		'discount_products',
		'discount_services',
		'transpot_service_id',
		'transpot_type',
		'transpot_price',
		'transpot_distance',
		'transpot_weight',
		'shipping_method',
		'remaining_m_point',
		'shipping_weight',
		'shipping_type',
		'tax',
		'cpoint',
		'mpoint',
		'sub_total',
		'total'
	];

	public function order(){
		return $this->belongsTo(Order::class,  'order_id', 'id');

	}
	public function order_products(){
		return $this->hasMany(OrderProduct::class, 'order_store_id');
	}

	public function store(){
		return $this->belongsTo(Store::class,  'store_id', 'id');
	}
	function transpot_service(){
		return $this->belongsTo(TranspotService::class, 'transpot_service_id', 'id');
	}
}
