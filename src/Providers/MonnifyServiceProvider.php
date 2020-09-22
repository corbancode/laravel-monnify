<?php

namespace Corbancode\Monnify\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

use Corbancode\Monnify\Monnify;
use Corbancode\Monnify\Facades\Monnify as MonnifyFacade;
/**
* Monnify service provider
*
* @author    Ayomide Olakulehin <oayomideelijah@gmail.com>
*/
class MonnifyServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap services.
    *
    * @return void
    */
    public function boot()
    {
        include __DIR__ . '/../Http/helpers.php';

        $this->publishes([
            __DIR__.'/../Config/monnify.php' => config_path('monnify.php'),
        ]);
    }

    /**
    * Register services.
    *
    * @return void
    */
    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/monnify.php', 'mouka.Monnify'
        );
        $this->registerFacades();
    }

    /**
     * Register Bouncer as a singleton.
     *
     * @return void
     */
    protected function registerFacades()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('monnify', MonnifyFacade::class);

        $this->app->singleton('monnify', function () {
            return app()->make(Monnify::class);
        });
    }
}
