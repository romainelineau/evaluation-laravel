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
    // édition d'un produit, on vérifie si la taille est sélectionnée ou non
    public function IsCheckedSize($idSize) {
        foreach ($this->sizes as $size) {
            if($size->id == $idSize) {
                return true;
            }
        }
        return false;
    }
    // édition d'un produit, on vérifie si la catégorie est sélectionnée ou non
    public function IsCheckedCategory($idCategory) {
        if($this->category_id == $idCategory) {
            return true;
        } else {
            return false;
        }

    }
}
