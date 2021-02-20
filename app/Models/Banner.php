<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'link', 'status', 'image', 'added_by'];

    public function getRules($act = 'add'){
        $rules = [
            'title' => 'required|string',
            'link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
            'image' =>'required|image|max:5120'
        ];
        if($act != 'add'){
            $rules['image'] = 'sometimes|image|max:5120';
        }
        return $rules;
    }

    public function created_by(){
        return $this->hasOne('App\User', 'id', 'added_by');
    }


}
