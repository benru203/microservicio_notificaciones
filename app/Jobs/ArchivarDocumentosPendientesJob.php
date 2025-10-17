<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Src\Aplicacion\ArchivarDocumento\DTOs\DocumentoDTO;
use Src\Aplicacion\ArchivarDocumento\Interfaces\Servicios\IDocumentoArchivarService;

class ArchivarDocumentosPendientesJob implements ShouldQueue
{
    use Queueable;

    protected IDocumentoArchivarService $documentoArchivarService;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(IDocumentoArchivarService $documentoArchivarService): void
    {
        $documentosPendientes = $documentoArchivarService->buscarDocumentoPendientePorArchivar();       
        foreach ($documentosPendientes as $documento) {
            $documentoDTO = new DocumentoDTO($documento->getId()); 
            $documentoArchivarService->archivarDocumento($documentoDTO);
            Log::channel('documentos')->info('Documento archivado automáticamente', [
                'id' => $documentoDTO->getId(),
                'fecha_archivado' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
                     
        }
       

    }
}
