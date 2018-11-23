<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Cocktail;
use App\Model\TagCategory;

class Tag extends Model
{
    protected $hidden = ['pivot'];

    public function category() {
        return $this->belongsTo(TagCategory::class, 'tag_category_id');
    }

    public function cocktails() {
        return $this->belongsToMany(Cocktail::class);
    }
}
