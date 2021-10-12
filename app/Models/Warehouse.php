<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = 'warehouse';
    protected $guarded = [];

    public function products() {
        return $this->belongstoMany(Product::class, 'warehouse_product', 'warehouse_id', 'product_id')->withPivot('quantity', 'created_at');
    }
}