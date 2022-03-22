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
class OrderVat extends Model
{
	protected $table = 'order_vat';

	protected $fillable = [
		'id_order',
		'vat_name',
		'vat_company',
		'vat_email',
		'vat_mst',
		'vat_address'
	];

}
