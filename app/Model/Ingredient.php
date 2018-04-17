<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Cocktail;
use App\Model\IngredientType;

class Ingredient extends Model 
{
    public function cocktails() {
        return $this->belongsToMany('Cocktail');
    }
}
    
