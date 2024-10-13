<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventsSilentlyDiscardingAttributes(!app()->isProduction());
    
        DB::whenQueryingForLongerThan(500, function(Connection $connection) {
            // Some code here
        }); // <- Closing bracket for the function
    
        $kernel = app(Kernel::class);
        
        $kernel->whenRequestLifecycleIsLongerThan(
            CarbonInterval::seconds(4),
            function() {
                // Some code here
            }
        ); // <- Closing bracket for the function
    
    } // <- Closing bracket for boot() method
}
