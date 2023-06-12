<?php

namespace App\Providers;

use App\Interfaces\Repository\RepositoryInterface;
use App\Interfaces\User\Repository\UserRepositoryInterface;
use App\Interfaces\User\Service\UserServiceInterface;
use App\Models\User;
use App\Repositories\Repository;
use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
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
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );

        $this->app->bind(
            RepositoryInterface::class,
            Repository::class
        );

        $this->app->bind(UserService::class, function () {
            $userRepository = new UserRepository(new User());
            return new UserService($userRepository);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
