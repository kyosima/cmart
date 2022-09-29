<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPayment extends Model
{
    protected $table = 'product_payment';
    protected $guarded =[];
    protected $fillable = [
        'product_id',
        'payment_id',
    ];
    
 
}
