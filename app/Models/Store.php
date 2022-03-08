<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

	protected $guarded = [];

    public $timestamps = false;

    public function province() {
        return $this->belongsto(Province::class, 'id_province', 'matinhthanh');
    } 
	public function district() {
        return $this->belongsto(District::class, 'id_district', 'maquanhuyen');
    } 
	public function ward() {
        return $this->belongsto(Ward::class, 'id_ward', 'maphuongxa');
    } 

    public function products(){
        return $this->belongsToMany(Product::class, 'product_store', 'id_ofstore', 'id_ofproduct')->withPivot(['soluong','for_user']);
    }
    public function owner()
    {
        return $this->belongsto(Admin::class, 'id_owner', 'id');
    }
    public function product_stores(){
		return $this->hasMany(ProductStore::class, 'id_ofstore');
	}

}
