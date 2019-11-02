<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as Query;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ApiModel extends Model
{
    public $timestamps = false;

    public static function validation(Request $request, array $options = [])
    {
        return Validator::make($request->all(), array_merge($options, []));
    }

    public function scopePaginateSelect(Query $query, Request $request): Query
    {
        return $query;
    }

    public function scopeWhereFilter(Query $query, Request $request): Query
    {
        return $query;
    }

    /**
     * テキスト用カスタム検索条件作成
     */
    public function scopeWherePartialMatchText(Query $query, $fields, $request)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        if (is_array($request)) {
            $query->where(function ($q) use ($request, $fields) {
                foreach ($request as $str) {
                    if (strlen($str) == 0) {
                        continue;
                    }

                    foreach ($fields as $field) {
                        $q->orWhere($field, 'LIKE', "%{$str}%");
                    }
                }
            });
        } elseif (0 < strlen($request)) {
            $query->where(function ($q) use ($request, $fields) {
                foreach ($fields as $field) {
                    $q->orWhere($field, 'LIKE', "%{$request}%");
                }
            });
        }
    }
}
