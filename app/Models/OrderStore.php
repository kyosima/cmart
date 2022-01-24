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
		'shipping_total',
		'shipping_method',
		'tax',
		'c_point',
		'm_point',
		'sub_total',
		'total'
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'id_order');
	}

	public function order_products(){
		return $this->hasOne(OrderProduct::class, 'id_order_store');
	}
}
