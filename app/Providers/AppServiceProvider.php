<?php

namespace App\Providers;
use Illuminate\Contracts\Http\Kernel as HttpKernel;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        if(app()->isProduction()) {
            //Моніторинг і логування окремих SQL-запитів.
            DB::listen(function ($query) {
                if($query->time > 100) {
                    logger()
                        ->channel('telegram')
                        ->debug('query longer than 1s:' . $query->sql, $query->bindings);
                }
            });

            // Request lifecycle //  для HTTP-запитів
            app(HttpKernel::class)->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                function() {
                    logger()
                        ->channel('telegram')
                        ->debug('whenQueryingForLongerThan:' . request()->url());
                }
            );
        }
    }

    public function register():void
    {
        $this->app->register(EventServiceProvider::class);

        $providers = [
//            ViewServicesProvider::class,
        ];



    }
}
