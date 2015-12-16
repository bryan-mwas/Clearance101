<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\ViewsController;

class SpecificFinancialAid extends ViewsController
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
        if(ViewsController::findSpec() != "Financial Aid"){
            return 'Oops! Seems like you are not the financial aid administrator';
        }
        return $next($request);
    }
}
