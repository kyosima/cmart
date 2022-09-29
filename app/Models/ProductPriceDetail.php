<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceDetail extends Model
{
    use HasFactory;
    protected $table = 'product_price_detail';
    protected $guarded = [];
    protected $fillable = [
        'product_price_id',
        'product_variation_id',
        'user_price_id',
        'price'
    ];
  
    function user_price(){
        return $this->belongsTo(UserPrice::class, 'user_price_id', 'id');
    }
}