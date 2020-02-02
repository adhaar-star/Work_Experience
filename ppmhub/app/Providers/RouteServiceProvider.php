<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();


        // StWork Routes
        $this->mapWebStWorksRoutes();

        // Sales Routes
        $this->mapWebSalesRoutes();

        // Billing Routes
        $this->mapWebBillingRoutes();

        // Master
        $this->mapWebMasterRoutes();

        // Setting
        $this->mapWebSettingRoutes();

        
        $this->mapWebProjectRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapWebSalesRoutes()
    {
        Route::middleware(['web', 'check-auth', 'role-auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/sales.php'));
    }

    protected function mapWebBillingRoutes()
    {
        Route::middleware(['web', 'check-auth', 'role-auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/billing.php'));

    }


    protected function mapWebStWorksRoutes()
    {
        Route::middleware(['web', 'check-auth', 'role-auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/st_works.php'));

    }

    protected function mapWebMasterRoutes()
    {
        Route::middleware(['web', 'check-auth', 'role-auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/master.php'));

    }

    protected function mapWebSettingRoutes()
    {
        Route::middleware(['web', 'check-auth', 'role-auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/setting.php'));

    }
    protected function mapWebProjectRoutes()
    {
        Route::middleware(['web', 'check-auth', 'role-auth'])
            ->namespace($this->namespace)
            ->group(base_path('routes/project.php'));

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
