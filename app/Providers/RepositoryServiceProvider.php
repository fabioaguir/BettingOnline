<?php

namespace Softage\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\Softage\Repositories\UserRepository::class, \Softage\Repositories\UserRepositoryEloquent::class );
        $this->app->bind(\Softage\Repositories\RoleRepository::class, \Softage\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\AreasRepository::class, \Softage\Repositories\AreasRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\ParametrosRepository::class, \Softage\Repositories\ParametrosRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\CampeonatosRepository::class, \Softage\Repositories\CampeonatosRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\EstornoVendedorRepository::class, \Softage\Repositories\EstornoVendedorRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\StatusRepository::class, \Softage\Repositories\StatusRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\TimesRepository::class, \Softage\Repositories\TimesRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\TemposRepository::class, \Softage\Repositories\TemposRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\StatusVendasRepository::class, \Softage\Repositories\StatusVendasRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\TipoApostasRepository::class, \Softage\Repositories\TipoApostasRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\TipoCotacaoRepository::class, \Softage\Repositories\TipoCotacaoRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\PremiacoesRepository::class, \Softage\Repositories\PremiacoesRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\VendedorRepository::class, \Softage\Repositories\VendedorRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\ConfVendasRepository::class, \Softage\Repositories\ConfVendasRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\PartidasRepository::class, \Softage\Repositories\PartidasRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\ModalidadesRepository::class, \Softage\Repositories\ModalidadesRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\CotacoesRepository::class, \Softage\Repositories\CotacoesRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\ApostasRepository::class, \Softage\Repositories\ApostasRepositoryEloquent::class);
        $this->app->bind(\Softage\Repositories\GolsRepository::class, \Softage\Repositories\GolsRepositoryEloquent::class);
        //:end-bindings:
    }
}
