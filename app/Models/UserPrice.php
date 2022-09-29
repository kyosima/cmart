<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class UserPrice extends Model
{
	protected $table = 'user_price';

	protected $casts = [
	];

	protected $fillable = [
		'label',
	];

}
