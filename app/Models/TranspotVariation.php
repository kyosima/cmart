<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class TranspotVariation extends Model
{
	protected $table = 'transpot_variation';

	protected $casts = [
	];

	protected $fillable = [
		'province_id',
		'transpot_to',
		'transpot_service_id'

	];

	public function province_from() {
        return $this->hasOne(Province::class, 'matinhthanh', 'province_id');
    }
	public function province_to() {
        return $this->hasOne(Province::class, 'matinhthanh', 'transpot_to');
    }
	function transpot_prices_details(){
        return $this->hasMany(TranspotPriceDetail::class, 'transpot_variation_id', 'id');
    }
	
}
