<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Cocktail;
use App\Model\Tag;

class TagCategory extends Model 
{
    public function cocktails() {
        return $this->belongsToMany('Cocktail');
    }

    public function tags() {
        return $this->belongsTo('Tag');
    }
}
    
