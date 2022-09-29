<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class StoreAdmin extends Model
{
	protected $table = 'store_admin';

	protected $casts = [
	];

	protected $fillable = [
		'store_id',
		'admin_id',
	];
	function admin(){
        return $this->hasOne(Admin::class, 'id', 'admin_id');

    }
}
