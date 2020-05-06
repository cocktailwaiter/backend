<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class History extends Model
{
    protected $guarded = [
        'id'
    ];

    public static function requestLog(Request $request, \App\Model\User $user = null)
    {
        $logging = new self;
        if ($user) {
            $logging->user_id = $user->id;
        }
        $logging->endpoint = $request->url();
        $logging->parameter = json_encode($request->query());
        $logging->user_agent = $request->header('User-Agent');
        $logging->ip_address = $request->ip();
        $logging->save();
    }
}
