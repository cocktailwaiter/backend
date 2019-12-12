<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CocktailService;

class CocktailController extends ApiController
{
    protected $cocktailService;
    protected $model = 'App\Model\Cocktail';

    public function __construct(
        CocktailService $cocktailService
    ) {
        $this->cocktailService = $cocktailService;
    }

    public function index(Request $request, $id)
    {
        $validator = $this->model::validation($request);

        $response = [];
        if ($validator->fails()) {
            $response['error'] = [];
            $response['error']["code"] = "403";
            $response['error']["messages"] = $validator->errors()->all();

            return response()->json($response);
        }

        $logging = new \App\Model\History;
        $logging->endpoint = $request->url();
        $logging->parameter = json_encode($request->query());
        $logging->save();

        $query = $this->cocktailService->searchCocktail($request, $id);
        $paginate = $query->paginate(1, ['*'], 'page', 1);

        $cocktails = [];
        foreach ($paginate as $data) {
            $cocktail = [];
            foreach (config('api.cocktail.response.fields') as $field) {
                switch ($field) {
                    case 'tags':
                        $cocktail[$field] = $this->tagFormat($data->$field);
                        break;
                    default:
                        $cocktail[$field] = $this->dataFormat($data->$field, 'string');
                        break;
                }
            }
            $cocktails[] = $cocktail;
        }

        return response()->json($this->makeApiResponseFormatByPaginateQueryAndData($paginate, $cocktails[0]));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function list(Request $request)
    {
        $validator = $this->model::validation($request);

        $response = [];
        if ($validator->fails()) {
            $response['error'] = [];
            $response['error']["code"] = "403";
            $response['error']["messages"] = $validator->errors()->all();

            return response()->json($response);
        }

        $logging = new \App\Model\History;
        $logging->endpoint = $request->url();
        $logging->parameter = json_encode($request->query());
        $logging->save();

        $query = $this->cocktailService->searchCocktail($request);
        $paginate = $query->paginate(50, ['*'], 'page', 1);

        $cocktails = [];
        foreach ($paginate as $data) {
            $cocktail = [];
            foreach (config('api.cocktail.response.fields') as $field) {
                switch ($field) {
                    case 'tags':
                        $cocktail[$field] = $this->tagFormat($data->$field);
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

    public function randomList(Request $request)
    {
        $validate_options = ['seed' => 'required'];
        $validate_options = [];
        $validator = $this->model::validation($request, $validate_options);

        $response = [];
        if ($validator->fails()) {
            $response['error'] = [];
            $response['error']["code"] = "403";
            $response['error']["messages"] = $validator->errors()->all();

            return response()->json($response);
        }

        $logging = new \App\Model\History;
        $logging->endpoint = $request->url();
        $logging->parameter = json_encode($request->query());
        $logging->save();

        return $this->list($request);
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
