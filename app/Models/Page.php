<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'summary', 'description', 'image', 'status', 'updated_by'];

    public function updated_user(){
    	return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function getRules(){
    	return [
    		'title' => 'required|string',	
    		'summary' => 'required|string',	
    		'description' => 'nullable|string',	
    		'status' => 'required|in:active,inactive',
    		'image' => 'sometimes|image|max:5120'
    	];
    }
}


