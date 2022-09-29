<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Country extends Model
{
	use Sluggable;
	protected $table = 'country';
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

	protected $casts = [
	];

	protected $fillable = [
		'name',
		'slug'
	];

}
