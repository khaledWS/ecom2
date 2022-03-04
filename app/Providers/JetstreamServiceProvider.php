<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Request;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::registerView(function () {
            if (Request::route()->getPrefix() == 'admin') {
                return view('auth.admin-register');
            }
            elseif(Request::route()->getPrefix() == 'vendor'){
                return view('auth.vendor-register');
            } else {
                return view('auth.register');
            }
        });

        Fortify::loginView(function () {
            if (Request::route()->getPrefix() == 'admin') {
                return view('auth.admin-login');
            } elseif (Request::route()->getPrefix() == 'vendor') {
                return view('auth.vendor-login');
            } else {
                return view('auth.login');
            }
        });

        // Fortify::redirects();
    }


    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
