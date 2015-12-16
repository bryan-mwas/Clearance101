<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\ViewsController;

class SpecificSBS extends ViewsController
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
        if(ViewsController::findSpec() != "SBS"){
            return 'Oops! Seems like you are not an SBS administrator';
        }
        return $next($request);
    }
}
