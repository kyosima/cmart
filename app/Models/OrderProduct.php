<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderProduct
 * 
 * @property int $id
 * @property int $id_order
 * @property int $id_product
 * @property int $quantity
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * 
 * @property Order $order
 * @property Product $product
 *
 * @package App\Models
 */
class OrderProduct extends Model
{
	protected $table = 'order_products';

	protected $casts = [
		'order_store_id' => 'int',
		'product_id' => 'int',
		'quantity' => 'int',
		'price' => 'float',
	];

	protected $fillable = [
		'order_id',
		'order_store_id',
		'product_id',
		'sku',
		'name',
		'feature_img',
		'slug',
		'cpoint',
		'mpoint',
		'quantity',
		'weight',
		'discount',
		'price',
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'order_id');
	}
	public function order_store()
	{
		return $this->belongsTo(OrderStỏe::class, 'order_store_id');
	}
	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}
}
