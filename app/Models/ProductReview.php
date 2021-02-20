<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = ['product_id', 'user_id', 'rate', 'review', 'status'];

    public function user_info(){
        return $this->hasOne('App\Models\UserInfo', 'user_id', 'user_id');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function product(){
    	return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
