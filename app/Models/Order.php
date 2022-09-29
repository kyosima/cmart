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
		'order_code',
		'payment_method',
		'shipping_total',
		'transpot_price_total',
		'c_point',
		'm_point',
		'tax_services',
		'total_tax_services',
		'tax',
		'sub_total',
		'vat_products',
		'discount_products',
		'total',
		'status',
		'user_id',
		'is_payment'
	];

	public function order_address()
	{
		return $this->hasOne(OrderAddress::class, 'order_id');
	}

	public function user()
	{
		return $this->belongsto(User::class, 'user_id');
	}

	public function order_products(){
		return $this->hasOne(OrderProduct::class, 'order_id');
	}
	public function order_stores(){
		return $this->hasMany(OrderStore::class, 'order_id','id');
	}


	public function order_info(){
		return $this->hasOne(OrderInfo::class, 'order_id');
	}
	public function order_vat(){
		return $this->hasOne(OrderVat::class, 'order_id');
	}

	public function order_shipping(){
        return $this->hasMany(ShippingBill::class, 'order_id', 'id');
    }

	public function order_payme()
	{
		return $this->hasOne(OrderPayme::class, 'order_id');
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
					->withPivot('id', 'quantity', 'price')
					->withTimestamps();
	}
}
