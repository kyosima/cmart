<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class UserLevel extends Model
{
	protected $table = 'user_level';

	protected $casts = [
	];

	protected $fillable = [
		'name',
		'user_price_id'
	];

}
