<?php

namespace App\Http\Middleware;

use App\Http\Controllers\RedirectController;
use Closure;

class SpecificSOA extends RedirectController
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
        if(RedirectController::getDepartment() != "SOA"){
            return 'Oops! Seems like you are not an SOA administrator';
        }
        return $next($request);
    }
}
