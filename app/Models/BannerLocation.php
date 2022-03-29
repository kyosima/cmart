<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerLocation extends Model
{
    use HasFactory;

    protected $table = 'banner_location';

    protected $guarded = [];

    public function getBanners(){
        return $this->hasMany(Banner::class, 'id_location', 'id');
    }
}
