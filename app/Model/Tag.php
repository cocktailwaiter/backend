<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Builder as Query;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Model\ApiModel;
use App\Model\Cocktail;
use App\Model\TagCategory;

class Tag extends ApiModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $hidden = ['pivot'];

    public function category()
    {
        return $this->belongsTo(TagCategory::class, 'tag_category_id');
    }

    public function cocktails()
    {
        return $this->belongsToMany(Cocktail::class);
    }

    public function scopePaginateSelect(Query $query, Request $request): Query
    {
        $effective_tag_ids = DB::table('cocktail_tag')
            ->distinct()
            ->groupBy('tag_id')
            ->pluck('tag_id')
            ->toArray();

        return $query
            ->select('tags.*')
            ->where('tags.tag_category_id', '!=', TagCategory::TAG_CATEGORY_ID_ALCOHOL_CONTENT)
            ->where('tags.tag_category_id', '!=', TagCategory::TAG_CATEGORY_ID_NOTE)
            ->whereIn('tags.id', $effective_tag_ids)
            ->with([
                'cocktails',
                'category',
            ]);
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
