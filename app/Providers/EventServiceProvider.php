<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Events\SubOrderCreated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen
        = [
            'App\Events\Event' => [
                'App\Listeners\EventListener' ,
            ] ,
            SubOrderCreated::class => [
                \App\Listeners\SubOrderCreated::class
            ]
        ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();


    }
}
