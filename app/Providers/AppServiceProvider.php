<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

use URL;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //enable debuggin mode for specific ips 
    $ips = array('103.123.224.4');
    if(in_array(request()->ip(), $ips)) { 
        \Barryvdh\Debugbar\Facade::enable();
        config(['app.debug' => true]);
    } 

      if(env('ENVIRONMENT') == "Production"){
        URL::forceScheme('https');
      } 
      Schema::defaultStringLength(191);
      Paginator::useBootstrap();
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
