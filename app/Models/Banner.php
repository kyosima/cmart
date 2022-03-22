<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = "banner";
    public $timestamps = false;
    // protected $fillable = [
    //     'product_name', 'product_desc', 'product_status'
    // ];
    protected $guarded =[];
    
    public function getRouteKeyName()
	{
	    return 'type';
	}
}
