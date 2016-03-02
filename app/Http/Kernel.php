<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'fit' => \App\Http\Middleware\SpecificFIT::class,
        'sls' => \App\Http\Middleware\SpecificSLS::class,
        'sbs' => \App\Http\Middleware\SpecificSBS::class,
        'cth' => \App\Http\Middleware\SpecificCTH::class,
        'soa' => \App\Http\Middleware\SpecificSOA::class,
        'smc' => \App\Http\Middleware\SpecificSMC::class,
        'shss' => \App\Http\Middleware\SpecificSHSS::class,
        'sfae' => \App\Http\Middleware\SpecificSFAE::class,
        'caf' => \App\Http\Middleware\SpecificCafeteria::class,
        'lib' => \App\Http\Middleware\SpecificLibrary::class,
        'games' => \App\Http\Middleware\SpecificGames::class,
        'finance' => \App\Http\Middleware\SpecificFinance::class,
        'financial_aid' => \App\Http\Middleware\SpecificFinancialAid::class,
        'extra' => \App\Http\Middleware\SpecificExtraCurricular::class,
        'mail' => \App\Http\Middleware\SpecificMail::class,
        'vc' => \App\Http\Middleware\VC::class,
        'cas.auth'  => \Subfission\Cas\Middleware\CASAuth::class,
        'cas.guest' => \Subfission\Cas\Middleware\RedirectCASAuthenticated::class,
    ];
}
