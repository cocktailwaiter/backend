<?php
namespace App\Services;

use App\Repositories\CocktailRepositoryInterface;

class CocktailService extends Service
{
    protected $cocktailRepo;

    public function __construct(
        CocktailRepositoryInterface $cocktailRepo
    ) {
        $this->cocktailRepo = $cocktailRepo;
    }

    /**
     * Create a new cocktail.
     *
     * @param $cocktail object item_id, user_id, body, username, email
     * @return Illuminate\Database\Eloquent\Model
     */
    public function createCocktail($cmt)
    {
        return $this->cocktailRepo->createCocktail($cmt);
    }

    /**
     * Get a cocktail by cocktail id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getCocktailById($id)
    {
        return $this->cocktailRepo->getCocktailById($id);
    }
}
