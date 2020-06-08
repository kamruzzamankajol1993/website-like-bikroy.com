<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }
}
