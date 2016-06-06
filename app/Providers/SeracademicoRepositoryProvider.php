<?php

namespace Softage\Providers;

use Illuminate\Support\ServiceProvider;

class SeracademicoRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            \Softage\Repositories\UserRepository::class,
            \Softage\Repositories\UserRepositoryEloquent::class
        );

        $this->app->bind(
            \Softage\Repositories\RoleRepository::class,
            \Softage\Repositories\RoleRepositoryEloquent::class
        );

        $this->app->bind(
            \Softage\Repositories\PermissionRepository::class,
            \Softage\Repositories\PermissionRepositoryEloquent::class
        );
		$this->app->bind(
			\Softage\Repositories\GuestRepository::class,
			\Softage\Repositories\GuestRepositoryEloquent::class
		);

		$this->app->bind(
			\Softage\Repositories\GenderRepository::class,
			\Softage\Repositories\GenderRepositoryEloquent::class
		);
		$this->app->bind(
			\Softage\Repositories\AddresRepository::class,
			\Softage\Repositories\AddresRepositoryEloquent::class
		);
		$this->app->bind(
			\Softage\Repositories\StateRepository::class,
			\Softage\Repositories\StateRepositoryEloquent::class
		);
	}
}