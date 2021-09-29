<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'product_categories';

    public function childrenCategories()
    {
        return $this->hasMany(ProductCategory::class, 'category_parent', 'id');
    }
}