<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    protected $fillable = ['offer_id', 'product_id', 'discount'];

    public function product_info(){
    	return $this->hasOne('App\Models\Product', 'id', 'product_id')->with('images');
    }
}
