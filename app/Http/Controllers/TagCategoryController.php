<?php
namespace App\Http\Controllers;

use App\Model\TagCategory;
use Illuminate\Http\Request;

class TagCategoryController extends ApiController
{
    protected $model = 'App\Model\TagCategory';

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

        $query = $this->model::
            paginateSelect($request)
            ->whereFilter($request);

        if ($request->has('seed')) {
            $query = $query->fetchRandomOrder($request->input('seed'));
        }

        $paginate = $query->paginate(50, ['*'], 'page', 1);

        $tag_category_categories = [];
        foreach ($paginate as $data) {
            $tag_category = [];
            foreach (config('api.tag_category.response.fields') as $field) {
                switch ($field) {
                    case 'category':
                        $tag_category[$field] = $this->tag_categoryCategoryFormat($data->$field);
                        break;
                    default:
                        $tag_category[$field] = $this->dataFormat($data->$field, 'string');
                        break;
                }
            }
            $tag_category_categories[] = $tag_category;
        }

        var_dump($tag_category_categories);

        return response()->json($this->makeApiResponseFormatByPaginateQueryAndData($paginate, $tag_category_categories));
    }

    protected function tag_categoryCategoryFormat($tag_category_category_data)
    {
        $response_tag_category_category = [];
        foreach (config('api.tag_category.response.field.category') as $tag_category_category_field) {
            switch ($tag_category_category_field) {
                default:
                    $response_tag_category_category[$tag_category_category_field] = $tag_category_category_data->$tag_category_category_field ?? null;
                    break;
            }
        }

        return $response_tag_category_category;
    }

    public function popularList(Request $request)
    {
        $validator = $this->model::validation($request);

        if ($validator->fails()) {
            return response()->json($this->makeResponseError($validator));
        }

        $query = TagCategory::fetchPopular();

        $paginate = $query->paginate(5, ['*'], 'page', 1);

        $tag_category_categories = [];
        foreach ($paginate as $data) {
            $tag_category = [];
            foreach (config('api.tag_category.response.fields') as $field) {
                switch ($field) {
                    case 'category':
                        break;
                    default:
                        $tag_category[$field] = $this->dataFormat($data->$field, 'string');
                        break;
                }
            }
            $tag_category_categories[] = $tag_category;
        }

        return response()->json($this->makeApiResponseFormatByPaginateQueryAndData($paginate, $tag_category_categories));
    }
}
