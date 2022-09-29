<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    use HasFactory;
    protected $table = 'product_brand';

    protected $guarded = [];

    protected $fillable = [
        'slug',
        'title',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function products() {
        return $this->hasMany(Product::class, 'brand', 'id');
    }

}