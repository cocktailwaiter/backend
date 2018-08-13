<?php
namespace App\Repositories;

interface CocktailRepositoryInterface
{
    /**
     * Create a new cocktail.
     *
     * @param $cocktail object item_id, user_id, body, username, email
     * @return Illuminate\Database\Eloquent\Model
     */
    public function createCocktail($cocktail);

    /**
     * Get a cocktail by cocktail id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getCocktailById($id);
}
