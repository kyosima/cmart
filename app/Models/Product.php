<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];

    public function productPrice() {
        return $this->hasOne(ProductPrice::class, 'id_ofproduct', 'id');
    }

    public function productBrand() {
        return $this->belongsto(Brand::class, 'brand', 'id');
    }

    public function productCalculationUnit() {
        return $this->belongsto(CalculationUnit::class, 'calculation_unit', 'id');
    }

    public function productCategory() {
        return $this->belongsto(ProductCategory::class, 'category_id', 'id');
    }

    public function warehouses() {
        return $this->belongstoMany(Warehouse::class, 'warehouse_product', 'product_id', 'warehouse_id');
    }

    public function ratings()
    {
        return $this->hasMany(ProductRating::class, 'product_id', 'id');
    }
}