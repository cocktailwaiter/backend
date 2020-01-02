<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tag;

class TagController extends ApiController
{
    protected $model = 'App\Model\Tag';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function list(Request $request)
    {
        $validator = $this->model::validation($request);

        if ($validator->fails()) {
            return response()->json($this->makeResponseError($validator));
        }

        \App\Model\History::requestLog($request);

        $query = $this->model::
            paginateSelect($request)
            ->whereFilter($request);

        if ($request->has('seed')) {
            $query = $query->fetchRandomOrder($request->input('seed'));
        }

        $paginate = $query->paginate(50, ['*'], 'page', 1);

        $tags = [];
        foreach ($paginate as $data) {
            $tag = [];
            foreach (config('api.tag.response.fields') as $field) {
                switch ($field) {
                    case 'category':
                        $tag[$field] = $this->tagCategoryFormat($data->$field);
                        break;
                    default:
                        $tag[$field] = $this->dataFormat($data->$field, 'string');
                        break;
                }
            }
            $tags[] = $tag;
        }

        return response()->json($this->makeApiResponseFormatByPaginateQueryAndData($paginate, $tags));
    }

    protected function tagCategoryFormat($tag_category_data)
    {
        $response_tag_category = [];
        foreach (config('api.tag.response.field.category') as $tag_category_field) {
            switch ($tag_category_field) {
                default:
                    $response_tag_category[$tag_category_field] = $tag_category_data->$tag_category_field ?? null;
                    break;
            }
        }

        return $response_tag_category;
    }

    public function popularList(Request $request)
    {
        $validator = $this->model::validation($request);

        if ($validator->fails()) {
            return response()->json($this->makeResponseError($validator));
        }

        \App\Model\History::requestLog($request);

        $query = Tag::fetchPopular();

        $paginate = $query->paginate(5, ['*'], 'page', 1);

        $tags = [];
        foreach ($paginate as $data) {
            $tag = [];
            foreach (config('api.tag.response.fields') as $field) {
                switch ($field) {
                    case 'category':
                        break;
                    default:
                        $tag[$field] = $this->dataFormat($data->$field, 'string');
                        break;
                }
            }
            $tags[] = $tag;
        }

        return response()->json($this->makeApiResponseFormatByPaginateQueryAndData($paginate, $tags));
    }
}
