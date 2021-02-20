<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_code', 'user_id', 'sub_total', 'delivery_charge', 'vat_amount', 'service_charge', 'status', 'total_amount'];

    public function user(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
