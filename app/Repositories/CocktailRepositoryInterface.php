<?php
namespace App\Repositories;

interface CocktailRepositoryInterface
{
    /**
     * Get a cocktail by parameters.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function searchCocktail($params);
}
