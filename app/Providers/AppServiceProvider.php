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
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        if(app()->isProduction()) {
            //Логування повільних SQL-запитів (з тривалістю більше 500 мс)
            DB::whenQueryingForLongerThan(500, function (Connection $connection) {
                logger()
                    ->channel('telegram')  //записує повідомлення до логів через канал telegram
                    ->debug('whenQueryingForLongerThan:' . $connection->totalQueryDuration());
            });

            //Моніторинг і логування окремих SQL-запитів.
            DB::listen(function ($query) {
                if($query->time > 100) {
                    logger()
                        ->channel('telegram')
                        ->debug('whenQueryingForLongerThan:' . $query->sql, $query->bindings);
                }
            });
            // Request lifecycle
            $kernel = app(HttpKernel::class); //  для HTTP-запитів

            $kernel->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4),
                function () {
                    logger()
                        ->channel('telegram')
                        ->debug('whenQueryingForLongerThan:' . request()->url());
                }
            );
        }
    }
}
