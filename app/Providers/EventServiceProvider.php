<?php

namespace App\Providers;

use App\Listeners\SendEmailNewUserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
   protected array $listen = [
       Registered::class=> [
           SendEmailNewUserListener::class,
       ],
   ];
}
