<?php

namespace App\Http\Middleware;

use Closure;
use App\Setting;
use Carbon;
use File;
class ExpireTime
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
        $expireTime = Setting::select('expiretime')->first();
        if(Carbon\Carbon::parse($expireTime->expiretime)->lt( Carbon\Carbon::today()))
        {
            return redirect()->route('expire');
        }
        else{
            return $next($request);
        }
        
    }
}
