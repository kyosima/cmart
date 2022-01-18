<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
        return $this->hasMany(ProductCategory::class, 'category_parent', 'id')->orderBy('priority')->with(['categories','products','linkToCategory']);
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
    public function parents()
    {
        return $this->belongsTo(ProductCategory::class, 'category_parent')->with('categories')->with('linkToCategory');
    }

    public function linkToCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'link_to_category', 'id')->with('products')->with('subproducts');
    }

    public function getAllChildren ()
    {
        $sections = new Collection();
        foreach ($this->childrenCategories as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllChildren());
        }
        return $sections;
    }
}
