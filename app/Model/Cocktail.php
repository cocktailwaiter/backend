<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Model\Ingredient;
use App\Model\Tag;
use App\Model\TagCategory;

class Cocktail extends Model
{
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public static function validation($request)
    {
        return Validator::make($request->all(), [
            'tags' => 'array',
            'tags.*' => 'integer',
        ]);
    }
}
