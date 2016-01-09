<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ViewsController;
use Closure;

class VC extends ViewsController
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
        if(ViewsController::leadership() != "Vice Chancellor"){
            return 'Warning! You do not have authorized access to this page.';
        }
        return $next($request);
    }
}
