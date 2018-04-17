<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Model\Cocktail;

class CocktailController extends BaseController 
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $filters = $request->all();

        $cocktails = Cocktail::with([
            'ingredients',
            'tags',
            'tags.category'
        ])
        ->get();

        return response()->json($cocktails);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $response = Cocktail::get();
        return response()->json($response);
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $response = Cocktail::find($id);
        return response()->json($response);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $updates = $request->all();
        unset($updates['q']);

        $response = false;
        $response = Cocktail::where('id', '=', $id)->update($updates);
        if ($response === 1) $response = true;
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $response = false;
        $response = Cocktail::destroy($id);
        if ($response === 1) $response = true;
        return response()->json($response);
    }
}
