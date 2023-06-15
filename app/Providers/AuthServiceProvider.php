<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Laravel\Socialite\Contracts\User as SocialiteUserContract;
use DutchCodingCompany\FilamentSocialite\Facades\FilamentSocialite as FilamentSocialiteFacade;
use DutchCodingCompany\FilamentSocialite\FilamentSocialite;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        FilamentSocialiteFacade::setCreateUserCallback(fn (SocialiteUserContract $oauthUser, FilamentSocialite $socialite) => $socialite->getUserModelClass()::create([
            'name' => $oauthUser->getName(),
            'email' => $oauthUser->getEmail(),
        ]));
    }
}
