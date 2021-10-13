<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property int $payment_method
 * @property float $shipping
 * @property float $sub_total
 * @property float $total
 * @property int $status
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * 
 * @property Collection|OrderAddress[] $order_addresses
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';

	protected $casts = [
		'payment_method' => 'int',
		'shipping_total' => 'float',
		'sub_total' => 'float',
		'total' => 'float',
		'status' => 'int',
		'status_shipping' => 'int'
	];

	protected $fillable = [
		'payment_method',
		'shipping_method',
		'shipping_total',
		'sub_total',
		'total',
		'status'
	];

	public function order_address()
	{
		return $this->hasOne(OrderAddress::class, 'id_order');
	}

	public function order_products(){
		return $this->hasOne(OrderProduct::class, 'id_order');
	}

	public function order_info(){
		return $this->hasOne(OrderInfo::class, 'id_order');
	}

	public function order_shipping(){
        return $this->hasMany(ShippingBill::class, 'order_id', 'id');
    }

	public function products()
	{
		return $this->belongsToMany(Product::class, 'order_products', 'id_order', 'id_product')
					->withPivot('id', 'quantity', 'price')
					->withTimestamps();
	}
}
