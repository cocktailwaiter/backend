<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Tag;

class TagCategory extends Model
{
    public function tags() {
        return $this->hasMany('App\Model\Tag');
    }
}
