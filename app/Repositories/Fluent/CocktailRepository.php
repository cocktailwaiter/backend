<?php
namespace App\Repositories\Fluent;

use App\Repositories\CocktailRepositoryInterface;
use App\Model\Cocktail;
use Illuminate\Http\Request;

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
     * @param $request Request
     * @return Illuminate\Database\Eloquent\Model
     */
    public function searchCocktail(Request $request, $id = null)
    {
        $query = Cocktail::
            paginateSelect($request)
            ->whereFilter($request);

        if (!is_null($id)) {
            $query->find($id);
        } elseif ($request->has('seed')) {
            $query = $query->fetchRandomOrder($request->input('seed'));
        }

        return $query;
    }
}
