<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Builder as Query;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Model\ApiModel;
use App\Model\Tag;
use App\Model\TagCategory;

class Cocktail extends ApiModel
{
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

    public function scopeWhereFilter(Query $query, $params): Query
    {
        $tags = $params['tags'];

        if (!empty($tags)) {
            $query->whereHas('tags', function ($query) use ($tags) {
                $query->wherePartialMatchText('tags.name', $tags);
            });
        }

        return $query;
    }

    public function scopeFetchRandomOrder(Query $query, $seed, array $params = []): Query
    {
        return $query->inRandomOrder($seed);
    }
}
