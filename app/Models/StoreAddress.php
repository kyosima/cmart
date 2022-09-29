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
	];

	protected $fillable = [
		'store_id',
		'country_id',
		'province_id',
		'district_id',
		'ward_id',
		'address'
	];

	public function province() {
        return $this->belongsto(Province::class, 'province_id', 'matinhthanh');
    } 
	public function district() {
        return $this->belongsto(District::class, 'district_id', 'maquanhuyen');
    } 
	public function ward() {
        return $this->belongsto(Ward::class, 'ward_id', 'maphuongxa');
    } 
	public function country() {
        return $this->belongsto(Country::class, 'country_id', 'id');
    } 
}
