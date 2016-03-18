<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\RedirectController;

class SpecificFinancialAid extends RedirectController
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
        if(RedirectController::getDepartment() != "FINANCIAL AID"){
            return 'Oops! Seems like you are not the financial aid administrator';
        }
        return $next($request);
    }
}
