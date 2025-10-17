<?php

namespace App\Console\Commands;

use App\Models\Repositorios\ArchivarDocumento\Documento;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Src\Aplicacion\ArchivarDocumento\DTOs\DocumentoDTO;
use Src\Aplicacion\ArchivarDocumento\Interfaces\Servicios\IDocumentoArchivarService;

class ArchivarDocumentosPendientes extends Command
{

    private IDocumentoArchivarService $documentoArchivarService;

    public function __construct(IDocumentoArchivarService $documentoArchivarService)
    {
        $this->documentoArchivarService = $documentoArchivarService;
        parent::__construct();
    }
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
        
        $documentosPendientes = $this->documentoArchivarService->buscarDocumentoPendientePorArchivar();
        foreach ($documentosPendientes as $documento) {
            $this->info('Archivando documento: ' . $documento->getId());
            $this->documentoArchivarService->archivarDocumento(new DocumentoDTO($documento->getId()));
            Log::channel('documentos')->info('Documento archivado automáticamente', [
                'id' => $documento->getId(),
                'dias_transcurridos' => $documento->FechaRegistro->diffInDays(Carbon::now()),
                'fecha_archivado' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

    }
}
