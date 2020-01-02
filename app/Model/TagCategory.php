<?php
namespace App\Model;

use App\Model\ApiModel;
use App\Model\Cocktail;
use App\Model\Tag;
use DB;

class TagCategory extends ApiModel
{
    const TAG_CATEGORY_ID_NOTE = 14;

    public function cocktails()
    {
        return $this->belongsToMany(Cocktail::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function scopeFetchPopular()
    {
        return DB::table('cocktail_tag')
            ->select('tags.name as name', 'cocktail_tag.tag_id as id', DB::raw('count(*) as count'))
            ->leftJoin('tags', 'tags.id', '=', 'cocktail_tag.tag_id')
            ->groupBy('tag_id')
            ->orderBy(DB::raw('count(*)'), 'desc')
            ->limit(5);
    }
}
