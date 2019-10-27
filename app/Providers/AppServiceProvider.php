<?php

namespace App\Providers;

use App\Http\Requests\PostStoreRequest;
use App\Policies\PostPolicy;
use App\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Post::class => PostPolicy::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // PostStoreRequest::class => 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(169);

        Blade::if('vueLink', function (string $currentUrl) {
            return Str::contains($currentUrl, '/api/');
        });
    }
}
