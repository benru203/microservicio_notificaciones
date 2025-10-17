<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Aplicacion\ArchivarDocumento\Interfaces\Servicios\IDocumentoArchivarService;
use Src\Aplicacion\ArchivarDocumento\Servicios\DocumentoArchivarService;
use Src\Aplicacion\WebHook\Interfaces\Servicios\IWebHookService;
use Src\Aplicacion\WebHook\Servicios\WebHookService;
use Src\Dominio\ArchivarDocumento\Interfaces\Repositorios\IDocumentoArchivarRepository;
use Src\Dominio\WebHook\Interfaces\Repositorios\IDocumentoRepository;
use Src\Infraestructura\ArchivarDocumento\Repositorios\DocumentoArchivarRepository;
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
        $this->app->bind(IDocumentoArchivarService::class, DocumentoArchivarService::class);
        $this->app->bind(IDocumentoArchivarRepository::class, DocumentoArchivarRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
