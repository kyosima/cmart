<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_user
 * @property int $name
 * @property string $fullname
 * @property string $phone
 * @property string $email
 * @property int $id_province
 * @property int $id_district
 * @property int $id_ward
 * @property string $address
 * @property string $updated_at
 * @property string $created_at
 */
class StoreAddress extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'store_address';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'name', 'fullname', 'phone', 'email', 'id_province', 'id_district', 'id_ward', 'address', 'updated_at', 'created_at'];

}
