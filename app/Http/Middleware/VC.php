<?php

namespace App\Http\Middleware;

use App\Http\Controllers\RedirectController;
use Closure;

class VC extends RedirectController
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
        if(RedirectController::getDepartment() != "Vice Chancellor"){
            return 'Warning! You do not have authorized access to this page.';
        }
        return $next($request);
    }
}
