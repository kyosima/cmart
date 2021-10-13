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
		'id_order' => 'int',
		'id_product' => 'int',
		'quantity' => 'int',
		'price' => 'float',
	];

	protected $fillable = [
		'id_order',
		'id_product',
		'quantity',
		'price',
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'id_order');
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'id_product');
	}
}
