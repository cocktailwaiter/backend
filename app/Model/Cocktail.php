<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Ingredient;
use App\Model\TagCategory;

class Cocktail extends Model
{
    public function ingredients() {
        return $this->belongsToMany(Ingredient::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function list () {
        return $this::with([
            'ingredients',
            'tags',
            'tags.category'
        ])
        ->get();
    }

}
