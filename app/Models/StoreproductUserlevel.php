<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class StoreproductUserlevel extends Model
{
	protected $table = 'storeproduct_userlevel';

	protected $casts = [
	];

	protected $fillable = [
		'storeproduct_id',
		'userlevel_id',
	];

	function userlevel(){
		return $this->hasOne(UserLevel::class, 'id', 'userlevel_id');
	}

}
