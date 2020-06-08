<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function subcategories()
    {
        return $this->belongsToMany('App\Subcategory')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
     public function favorite_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved',1);
    }
}
