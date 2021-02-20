<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['order_code', 'user_id', 'seller_id', 'product_id', 'price', 'quantity', 'total_amount','status'];

	public function user(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function product(){
    	return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public function seller(){
    	return $this->hasOne('App\User', 'id', 'seller_id');
    }
}
