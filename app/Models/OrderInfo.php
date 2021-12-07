<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderInfo
 * 
 * @property int $id
 * @property int $id_order
 * @property string $fullname
 * @property string $phone
 * @property string $email
 * @property string|null $note
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * 
 * @property Order $order
 *
 * @package App\Models
 */
class OrderInfo extends Model
{
	protected $table = 'order_info';

	protected $casts = [
		'id_order' => 'int'
	];

	protected $fillable = [
		'id_order',
		'fullname',
		'phone',
		'email',
		'note'
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'id_order');
	}
}
