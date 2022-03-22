<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StoreAddress
 * 
 * @property int $id
 * @property int $id_user
 * @property int $name
 * @property string $fullname
 * @property string $phone
 * @property string $email
 * @property int $id_province
 * @property int $id_district
 * @property int $id_ward
 * @property string $address
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class StoreAddress extends Model
{
	protected $table = 'store_address';

	protected $casts = [
		'id_user' => 'int',
		'name' => 'int',
		'id_province' => 'int',
		'id_district' => 'int',
		'id_ward' => 'int'
	];

	protected $fillable = [
		'id_user',
		'name',
		'fullname',
		'phone',
		'email',
		'id_province',
		'id_district',
		'id_ward',
		'address'
	];

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
