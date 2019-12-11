<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function picture() {
        return $this->hasOne(Picture::class);
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function sizes() {
        return $this->belongsToMany(Size::class);
    }
}
