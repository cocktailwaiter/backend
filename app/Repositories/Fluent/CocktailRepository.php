<?php
namespace App\Repositories\Fluent;

use App\Repositories\CocktailRepositoryInterface;
use App\Model\Cocktail;

class CocktailRepository extends AbstractFluent implements CocktailRepositoryInterface
{
    protected $table = 'cocktails';

    /**
     * Get a table name.
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->table;
    }

    /**
     * Create a new cocktail.
     *
     * @param $cocktail object item_id, user_id, body, username, email
     * @return Illuminate\Database\Eloquent\Model
     */
    public function createCocktail($cocktail)
    {
        return Cocktail::with([
            'ingredients',
            'tags',
            'tags.category'
        ])
        ->get();
    }

    /**
     * Get a cocktail by cocktail id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getCocktailById($id)
    {
        return \DB::table($this->getTableName())
            ->where($this->getTableName().'.id', $id)
            ->first();
    }
}
