<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

	protected $fillable = ['title', 'slug', 'summary', 'image', 'status', 'added_by', 'start_time', 'end_time'];

	public function offeredProducts(){
		return $this->hasMany('App\Models\OfferProduct', 'offer_id', 'id')->with('product_info');
	}

    public function getRules($act='add'){
    	$rules = [
    		'title' => 'required|string',
    		'summary' => 'nullable|string',
    		'image' => 'required|image|max:5120',
    		'start_time' => 'required|date_format:Y-m-d H:i:s',
    		'end_time' => 'required|date|after:start_time',
    		'status' => 'required|in:active,inactive',
    		'product_id.*' => 'required|exists:products,id',
    		'discount.*' => 'required|numeric',
    	];

    	if ($act == 'update') {
    		$rules['image'] = "sometimes|image|max:5120";
    	}
    	return $rules;
    }

     public function getSlug($title){
        $slug = \Str::slug($title);
        if ($this->where('slug', $slug)->count() > 0){
            $slug .= date('Ymdhis').rand(0,999);
        }
        return $slug;
    }
}
