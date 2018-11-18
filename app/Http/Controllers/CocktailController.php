<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Services\CocktailService;

class CocktailController extends BaseController
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

        $cocktails = $this->cocktailService->searchCocktail($requestParams);

        return response()->json($cocktails);
    }
}
