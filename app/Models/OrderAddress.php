<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderAddress
 * 
 * @property int $id
 * @property int $id_order
 * @property int $id_province
 * @property int $id_district
 * @property int $id_ward
 * @property string $address
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * 
 * @property Order $order
 *
 * @package App\Models
 */
class OrderAddress extends Model
{
	protected $table = 'order_address';

	protected $casts = [
		'id_order' => 'int',
		'id_province' => 'int',
		'id_district' => 'int',
		'id_ward' => 'int'
	];

	protected $fillable = [
		'id_order',
		'id_province',
		'id_district',
		'id_ward',
		'address',
		'address_full'
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'id_order');
	}

	public function productCategory() {
        return $this->belongsto(ProductCategory::class, 'category_id', 'id');
    } 

	public function province() {
        return $this->belongsto(Province::class, 'id_province', 'matinhthanh');
    } 
	public function district() {
        return $this->belongsto(District::class, 'id_district', 'maquanhuyen');
    } 
	public function ward() {
        return $this->belongsto(Ward::class, 'id_ward', 'maphuongxa');
    } 
}
