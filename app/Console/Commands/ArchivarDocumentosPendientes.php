<?php

namespace App\Console\Commands;

use App\Jobs\ArchivarDocumentosPendientesJob;
use App\Models\Repositorios\ArchivarDocumento\Documento;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Src\Aplicacion\ArchivarDocumento\DTOs\DocumentoDTO;
use Src\Aplicacion\ArchivarDocumento\Interfaces\Servicios\IDocumentoArchivarService;

class ArchivarDocumentosPendientes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:archivar-documentos-pendientes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archiva documentos pendientes con más de 90 días';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando proceso de archivado de documentos pendientes...');        
        ArchivarDocumentosPendientesJob::dispatch();
        $this->info('Job despachado correctamente');       
        return Command::SUCCESS;
    }
}
