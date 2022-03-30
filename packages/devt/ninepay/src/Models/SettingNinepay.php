<?php

namespace Devt\Ninepay\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingNinepay extends Model
{
    use HasFactory;
    protected $table = 'setting_payment_ninepay';

    protected $guarded = [];

}
