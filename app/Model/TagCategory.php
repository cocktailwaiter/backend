<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Cocktail;
use App\Model\Tag;

class TagCategory extends ApiModel
{
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function cocktails() {
        return $this->belongsToMany(Cocktail::class);
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }
}
