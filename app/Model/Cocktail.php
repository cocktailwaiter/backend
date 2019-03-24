<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Builder as Query;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\ApiModel;
use App\Model\Tag;
use App\Model\TagCategory;

class Cocktail extends ApiModel
{
    protected $guarded = [
        'id'
    ];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public static function validation($request, array $options = [])
    {
        return Validator::make($request->all(), array_merge($options, [
            'tags' => 'array',
            'tags.*' => 'string',
        ]));
    }

    public function scopePaginateSelect(Query $query): Query
    {
        return $query
            ->select('cocktails.*')
            ->with([
                'tags',
                'tags.category',
            ]);
    }

    public function scopeWhereFilter(Query $query, Request $request): Query
    {
        if ($request->has('tags')) {
            $query->join('cocktail_tag', 'cocktail_tag.cocktail_id', 'cocktails.id');
            $query->join('tags', 'tags.id', 'cocktail_tag.tag_id');
            $query->wherePartialMatchText('tags.name', $request->input('tags'));
        }

        $query->groupBy('cocktails.id');

        return $query;
    }

    public function scopeFetchRandomOrder(Query $query, $seed): Query
    {
        return $query->inRandomOrder($seed);
    }
}
