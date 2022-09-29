<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;
    protected $table = 'product_price';
    protected $guarded = [];
    protected $fillable = [
        'product_id',
        'cpoint',
        'mpoint',
        'fee_process',
        'tax_gtgt',
        'tax_ttdb',
        'tax_nt_tndn',
        'tax_nt_gtgt',
    ];
    function product_price_details(){
        return $this->hasMany(ProductPriceDetail::class, 'product_price_id', 'id');

    } 
    function product_price_detail(){
        return $this->hasOne(ProductPriceDetail::class, 'product_price_id', 'id');

    }
}