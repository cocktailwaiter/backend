<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class User extends Model
{
    // protected $dates = ['deleted_at'];

    protected $guarded = [
        'id'
    ];

    public static function getUserBySession($session, $autoCreateUser = True)
    {
        $user = self::where('session', '=', $session)->first();

        if (!$user && $autoCreateUser) {
            $user = new self;
            $user->session = $session;
            $user->timestamps = false;
            $user->save();
        }

        return $user;
    }
}
