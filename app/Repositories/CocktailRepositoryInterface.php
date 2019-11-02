<?php
namespace App\Repositories;

use Illuminate\Http\Request;

interface CocktailRepositoryInterface
{
    /**
     * Get a cocktail by parameters.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function searchCocktail(Request $request, $id = null);
}
