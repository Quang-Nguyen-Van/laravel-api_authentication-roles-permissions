<?php

namespace App\Providers;

use App\Events\Models\Users\UserCreated;
use App\Events\Models\Users\UserUpdated;
use App\Listeners\SendWelcomeEmail;
use App\Subscribers\Models\PostSubscriber;
use App\Subscribers\Models\UserSubscriber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // UserCreated::class => [
        //     SendWelcomeEmail::class,
        // ],
    ];

    protected $subscribe = [
        UserSubscriber::class,
        PostSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
