<?php
namespace App\Services;

use App\Repositories\CocktailRepositoryInterface;

class CocktailService extends Service
{
    protected $cocktailRepository;

    public function __construct(
        CocktailRepositoryInterface $cocktailRepository
    ) {
        $this->cocktailRepository = $cocktailRepository;
    }

    /**
     * Get a cocktail by cocktail id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function searchCocktail($params)
    {
        return $this->cocktailRepository->searchCocktail($params);
    }
}
