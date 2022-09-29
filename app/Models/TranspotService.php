<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class TranspotService extends Model
{
	protected $table = 'transpot_services';

	protected $casts = [
	];

	protected $fillable = [
		'title',
		'slug',
		'sku',
		'type'
	];


	function transpot_prices_details(){
        return $this->hasMany(TranspotPriceDetail::class, 'transpot_service_id', 'id');
    }
	
	function transpot_variations(){
        return $this->hasMany(TranspotVariation::class, 'transpot_service_id', 'id');
    }

}
