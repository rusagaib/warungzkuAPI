<?php

namespace App\Providers;

use App\Models\warungapiPersonalAccessToken;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

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
        //JsonResource::withoutWrapping();
        // Schema::defaultStringLength(191);
        Sanctum::usePersonalAccessTokenModel(warungapiPersonalAccessToken::class);
    }
}
