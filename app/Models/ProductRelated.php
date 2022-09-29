<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRelated extends Model
{
    protected $table = 'product_related';
    protected $guarded =[];
    protected $fillable = [
        'product_id',
        'product_related_id',
    ];
    
    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_related_id');
    }

}
