<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class TranspotPriceDetail extends Model
{
	protected $table = 'transpot_price_detail';

	protected $casts = [
	];

	protected $fillable = [
		'transpot_service_id',
		'transpot_variation_id',
		'user_level_id',
		'type',
		'limit_weight_min',
		'limit_weight_max',
		'fee_min',
		'fee_default',
		'fee_package',
		'fee_distance',
		'fee_weight',
	];

	function user_level(){
		return $this->belongsTo(UserLevel::class, 'user_level_id', 'id');
	}
	function transpot_variation(){
		return $this->belongsTo(TranspotVariation::class, 'transpot_variation_id', 'id');
	}

}
