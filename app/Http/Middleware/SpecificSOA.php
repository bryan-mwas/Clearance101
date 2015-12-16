<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ViewsController;
use Closure;

class SpecificSOA extends ViewsController
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
        if(ViewsController::findSpec() != "SOA"){
            return 'Oops! Seems like you are not an SOA administrator';
        }
        return $next($request);
    }
}
