<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\User as SocialiteUserContract;
use DutchCodingCompany\FilamentSocialite\Facades\FilamentSocialite as FilamentSocialiteFacade;
use DutchCodingCompany\FilamentSocialite\FilamentSocialite;
use Laravel\Socialite\Contracts\Factory;

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
    public function boot(): void
    {
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('mock', function ($app) use ($socialite) {
            $config = $app['config']['services.mock'];
            //dd($config);
            return $socialite->buildProvider(SocialiteMockProvider::class, $config);
        });
        FilamentSocialiteFacade::setCreateUserCallback(function (SocialiteUserContract $oauthUser, FilamentSocialite $socialite) {

           $user = $socialite->getUserModelClass()::create([
                'name' => $oauthUser->getName(),
                'email' => $oauthUser->getEmail(),
            ]);
           $user->assignRole(Role::SIMPLE_USER_ROLE_NAME);
           return $user;
        });
    }
}
