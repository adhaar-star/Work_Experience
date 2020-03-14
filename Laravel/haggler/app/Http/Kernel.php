<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
       
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'api' => \App\Http\Middleware\API::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'acl'   => \App\Http\Middleware\Acl::class,
        'VendorMiddleware'   => \App\Http\Middleware\VendorMiddleware::class,
    ];


    public function __construct(Application $app, Router $router) {

        parent::__construct($app, $router);
        $b = '';
        //@list(,$a, $b, $c, $d) = explode('/', $_SERVER['REQUEST_URI']);

        if (!stripos($_SERVER['REQUEST_URI'], 'user/WebServices')) {
            array_push($this->middleware, \App\Http\Middleware\EncryptCookies::class);
            array_push($this->middleware, \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class);
            array_push($this->middleware, \Illuminate\Session\Middleware\StartSession::class);
            array_push($this->middleware, \Illuminate\View\Middleware\ShareErrorsFromSession::class);
           // array_push($this->middleware, \App\Http\Middleware\VerifyCsrfToken::class);
        }

    }

}
