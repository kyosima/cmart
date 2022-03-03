<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodOption extends Model
{
    use HasFactory;
    protected $table = 'payment_method_options';
    protected $guarded = [];
    
}
