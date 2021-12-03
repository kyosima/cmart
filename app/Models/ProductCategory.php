<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'product_categories';

    public function categories()
    {
        return $this->belongsTo(ProductCategory::class, 'category_parent', 'id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(ProductCategory::class, 'category_parent', 'id')->with('categories')->with('products');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    // public function products() {
    //     return $this->hasManyThrough(Product::class, ProductCategory::class, 'category_parent', 'category_id', 'id');
    // }

    public function subproducts()
    {
        return $this->hasManyThrough(Product::class, ProductCategory::class, 'category_parent', 'category_id');
    }

    // RECURSIVE PARENT (ĐỂ LÀM BREADCUMBS)
    public function parents() {
        return $this->belongsTo(ProductCategory::class, 'category_parent')->with('categories');
    }

}