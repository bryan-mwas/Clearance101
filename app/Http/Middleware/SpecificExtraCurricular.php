<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\RedirectController;

class SpecificExtraCurricular extends RedirectController
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
        if(RedirectController::getDepartment() != "EXTRA CURRICULAR ACTIVITIES"){
            return 'Oops! Seems like you are not the Extra-Curricular administrator';
        }
        return $next($request);
    }
}
