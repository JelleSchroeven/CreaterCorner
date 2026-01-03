<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Shop;
use App\Policies\ShopPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Shop::class => ShopPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
