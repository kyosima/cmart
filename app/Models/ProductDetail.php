<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_detail';
    protected $guarded =[];
    protected $fillable = [
        'product_id',
        'feature_img',
        'gallery',
        'weight',
        'height',
        'width',
        'length',
        'description',
        'meta_description',
        'meta_keyword'
    ];
 
}
