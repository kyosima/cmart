<?php

namespace Devt\Ninepay\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPaymentNinepay extends Model
{
    use HasFactory;
    protected $table = 'history_payment_ninepay';

    protected $guarded = [];

}
