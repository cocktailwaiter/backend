<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Builder as Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\ApiModel;
use App\Model\Cocktail;
use App\Model\TagCategory;

class Tag extends ApiModel
{
    protected $hidden = ['pivot'];

    public function category() {
        return $this->belongsTo(TagCategory::class, 'tag_category_id');
    }

    public function cocktails() {
        return $this->belongsToMany(Cocktail::class);
    }

    public static function validation(Request $request, array $options = [])
    {
        return Validator::make($request->all(), array_merge($options, []));
    }

    public function scopePaginateSelect(Query $query, Request $request): Query
    {
        return $query
            ->select('tags.*')
            ->with([
                'cocktails',
                'category',
            ]);
    }

    public function scopeWhereFilter(Query $query, Request $request): Query
    {
        return $query;
    }

    public function scopeFetchRandomOrder(Query $query, int $seed): Query
    {
        return $query->inRandomOrder($seed);
    }
}
