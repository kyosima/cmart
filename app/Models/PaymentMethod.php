<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = 'payment_method';
    protected $guarded = [];


    public function options()
    {
        return $this->hasMany(PaymentMethodOption::class, 'payment_method_id', 'id');
    }
}
