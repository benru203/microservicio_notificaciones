<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Aplicacion\WebHook\Interfaces\Servicios\IWebHookService;
use Src\Aplicacion\WebHook\Servicios\WebHookService;
use Src\Dominio\WebHook\Interfaces\Repositorios\IDocumentoRepository;
use Src\Infraestructura\Repositorios\DocumentoRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IWebHookService::class, WebHookService::class);
        $this->app->bind(IDocumentoRepository::class, DocumentoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
