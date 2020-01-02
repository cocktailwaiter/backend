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

    public static function requestLog(Request $request)
    {
        $logging = new self;
        $logging->endpoint = $request->url();
        $logging->parameter = json_encode($request->query());
        $logging->user_agent = $request->header('User-Agent');
        $logging->ip_address = $request->ip();
        $logging->save();
    }
}
