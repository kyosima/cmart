<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

	protected $guarded = [];
    protected $table = 'stores';
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = [
        'title',
        'slug',
        'introduce',
    ];

    function store_address(){
        return $this->hasOne(StoreAddress::class, 'store_id', 'id');
    }

    function admins(){
    	return $this->belongsToMany(Admin::class, 'store_admin', 'store_id', 'admin_id');
    }

    function store_admins(){
        return $this->hasMany(StoreAdmin::class, 'store_id', 'id');
    }
    
    function store_products(){
        return $this->hasMany(StoreProduct::class, 'store_id', 'id');

    }
    
}
