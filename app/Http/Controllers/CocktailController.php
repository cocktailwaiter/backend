<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CocktailService;

class CocktailController extends ApiController
{
    protected $cocktailService;

    public function __construct(
        CocktailService $cocktailService
    ) {
        $this->cocktailService = $cocktailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function list(Request $request)
    {
        $model = 'App\Model\Cocktail';
        $validator = $model::validation($request);

        $response = [];
        if ($validator->fails()) {
            $response['error'] = [];
            $response['error']["code"] = "403";
            $response['error']["messages"] = $validator->errors()->all();

            return response()->json($response);
        }

        $requestParams = [];
        $requestParams['tags'] = $request->input('tags', []);

        $query = $this->cocktailService->searchCocktail($requestParams);
        $paginate = $query->paginate(50, ['*'], 'page', 1);

        $cocktails = [];
        foreach ($paginate as $data) {
            $cocktail = [];
            foreach (config('api.cocktail.response.fields') as $field) {
                switch ($field) {
                    case 'tags':
                        $cocktail[$field] = $this->tagFormat($data->$field);
                        break;
                    case 'updated_at':
                        $cocktail[$field] = $this->dataFormat($data->$field, 'datetime');
                        break;
                    default:
                        $cocktail[$field] = $this->dataFormat($data->$field, 'string');
                        break;
                }
            }
            $cocktails[] = $cocktail;
        }

        return response()->json($this->makeApiResponseFormatByPaginateQueryAndData($paginate, $cocktails));
    }

    protected function tagFormat($tags_data)
    {
        $response_tags = [];
        foreach($tags_data as $tag_data) {
            $response_tag = [];
            foreach (config('api.cocktail.response.field.tag') as $tag_field) {
                switch ($tag_field) {
                    case 'tag_category':
                        $response_tag[$tag_field] = $this->tagCategoryFormat($tag_data->category);
                        break;
                    default:
                        $response_tag[$tag_field] = $tag_data->$tag_field ?? null;
                        break;
                }
            }
            $response_tags[] = $response_tag;
        }

        return $response_tags;
    }

    protected function tagCategoryFormat($tag_category_data)
    {
        $response_tag_category = [];
        foreach (config('api.cocktail.response.field.tag_category') as $tag_category_field) {
            switch ($tag_category_field) {
                default:
                    $response_tag_category[$tag_category_field] = $tag_category_data->$tag_category_field ?? null;
                    break;
            }
        }

        return $response_tag_category;
    }
}
