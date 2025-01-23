<?php

namespace App\Providers;

use App\Models\Booking;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        view()->composer(['layouts.navbars.auth.nav','components.fixed-plugin'], function ($view) {
             // Get all bookings
        $bookings = Booking::all();

        // Filter bookings where `noti` is `0` or `false`
        $unnotifiedBookings = $bookings->where('noti', 0);

        // Count bookings where `noti` is `0` or `false`
        $unseenCount = $unnotifiedBookings->count();

        // Reverse the bookings array
        $bookings = $bookings->reverse();

        // Pass data to the view
        $view->with([
            'bookings' => $bookings,
            'unseenCount' => $unseenCount,
        ]);
        
        });
    }
}
