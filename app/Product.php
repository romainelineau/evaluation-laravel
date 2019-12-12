<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'visible', 'status', 'reference', 'category_id'
    ];

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
