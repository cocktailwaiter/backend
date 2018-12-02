<?php
namespace App\Repositories\Fluent;

use App\Repositories\CocktailRepositoryInterface;
use App\Model\Cocktail;

class CocktailRepository extends AbstractFluent implements CocktailRepositoryInterface
{
    /**
     * Get a table name.
     *
     * @return string
     */
    public function getTableName()
    {
        return (new Cocktail)->getTable();
    }

    /**
     * Get a cocktail by parameters
     *
     * @param $params array
     * @return Illuminate\Database\Eloquent\Model
     */
    public function searchCocktail($params)
    {
        $tags = value($params['tags']);
        $seed = $params['seed'];

        $query = Cocktail::
            paginateSelect()
            ->whereFilter($params);

        if (!empty($seed)) {
            $query = $query->fetchRandomOrder(null);
        }

        return $query;
    }
}
