<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\RedirectController;

class SpecificSMC extends RedirectController
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
        if(RedirectController::getDepartment() != "SMC"){
            return 'Oops! Seems like you are not an SMC administrator';
        }
        return $next($request);
    }
}
