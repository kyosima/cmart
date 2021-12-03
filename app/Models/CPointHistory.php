<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPointHistory extends Model
{
    protected $table = 'cpoint_history';

	protected $casts = [
		'c_point' => 'int',
	];

	protected $fillable = [
		'c_point',
	];


}
