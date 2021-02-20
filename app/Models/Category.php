<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['title', 'summary', 'status', 'is_parent', 'parent_id', 'image', 'slug', 'added_by'];

    public function products(){
        return $this->hasMany('App\Models\Product', 'cat_id', 'id')->where('status', 'active')->orderBy('id', 'DESC')->limit(48);
    }

    public function shiftChild($child_id, $new_parent_id){
        return $this->whereIn('id', $child_id)->update(['parent_id'=>$new_parent_id]);
    }

    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }

    public function getChildCat($parent_id){
        return $this->where('parent_id', $parent_id)->get();
    }

    public function parent_info(){
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }

    public function getSlug($title){
        $slug = \Str::slug($title);
        if ($this->where('slug', $slug)->count() > 0){
            $slug .= date('Ymdhis');
        }
        return $slug;
    }

    public function child_cats(){
        return $this->hasMany('App\Models\Category', 'parent_id', 'id')->where('status', 'active');
    }

    public function getAllCategories(){
        return $this->where('status', 'active')->where('parent_id', null)->with('child_cats')->orderBy('title', 'ASC')->get();
    }

    public function getRules(){
        return [
          'title' => 'required|string',
          'summary' => 'nullable|string',
          'status' => 'required|in:active,inactive',
          'is_parent' => 'sometimes|in:1',
          'parent_id' => 'nullable|exists:categories,id',
          'image' => 'sometimes|image|max:2048'
        ];
    }
}
