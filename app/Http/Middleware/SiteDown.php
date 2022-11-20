<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Setting;
class SiteDown
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = Setting::first()->status;
        if($status || (Auth::check() && Auth::user()->hasAccess(['admin-panel'])))
        {
          return $next($request);
        }
        else{
          return response()->json(['error'=>'error SiteDown'],430);
        }

    }
}
