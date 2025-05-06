<?php

namespace AscentCreative\Geo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\Router;

class GeoServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
   
    $this->mergeConfigFrom(
        __DIR__.'/../config/geo.php', 'geo'
    );

    $this->app->register(\AscentCreative\Geo\Providers\EventServiceProvider::class);

  }

  public function boot()
  {

    $this->loadViewsFrom(__DIR__.'/../resources/views', 'geo');

    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    $this->bootPublishes();
    
  }

  

  // register the components
  public function bootComponents() {

  }




  

    public function bootPublishes() {

    //   $this->publishes([
    //     __DIR__.'/Assets' => public_path('vendor/ascentcreative/geo'),
    
    //   ], 'public');

      $this->publishes([
        __DIR__.'/../config/geo.php' => config_path('geo.php'),
      ]);

    }



}