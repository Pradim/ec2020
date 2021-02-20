<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'summary', 'description', 'slug', 'cat_id', 'sub_cat_id', 'price', 'discount', 'brand', 'stock', 'vendor_id', 'status', 'is_featured', 'added_by'];

    public function cat_info(){
        return $this->hasOne('App\Models\Category', 'id', 'cat_id');
    }

    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category', 'id', 'sub_cat_id');
    }

    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }

    public function vendor_info(){
        return $this->hasOne('App\User', 'id', 'vendor_id');
    }

    public function images(){
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id');
    }

    public function related_products(){
        return $this->hasMany('App\Models\Product', 'cat_id', 'cat_id')->where('status', 'active')->limit(10);
    }

    public function reviews(){
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id')->where('status', 'active')->with(['user_info', 'user'])->orderBy('id', 'DESC');
    }

    public function getRules(){
        return [
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'cat_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:100',
            'discount' => 'nullable|numeric|min:0|max:70',
            'stock' => 'nullable|numeric|min:0',
            'brand' => 'nullable|string',
            'vendor_id' => 'nullable|exists:users,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'image.*' => 'sometimes|image|max:5120'
        ];
    }

    public function getSellerRules(){
        return [
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'nullable|string',
            'cat_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:100',
            'discount' => 'nullable|numeric|min:0|max:70',
            'stock' => 'nullable|numeric|min:0',
            'brand' => 'nullable|string',
            'is_featured' => 'sometimes|in:1',
            'image.*' => 'sometimes|image|max:5120'
        ];
    }

    public function getSlug($title){
        $slug = \Str::slug($title);
        if ($this->where('slug', $slug)->count() > 0){
            $slug .= date('Ymdhis').rand(0,999);
        }
        return $slug;
    }
}
