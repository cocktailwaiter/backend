<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Cocktail;
use App\Model\TagCategory;

class Tag extends Model
{
    protected $hidden = ['pivot'];

    public function cocktails() {
        return $this->belongsToMany('Cocktail');
    }

    public function categories() {
        return $this->belongsTo('TagCategory');
    }

}
