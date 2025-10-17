<?php

namespace Src\Infraestructura\ArchivarDocumento\Repositorios;

use App\Models\Repositorios\ArchivarDocumento\Documento as DocumentoModel;
use Carbon\Carbon;
use Src\Dominio\ArchivarDocumento\Entidades\Documento;
use Src\Dominio\ArchivarDocumento\Interfaces\Repositorios\IDocumentoArchivarRepository;

class DocumentoArchivarRepository implements IDocumentoArchivarRepository{

    /**
     * Busca los documentos pendientes por archivar.
     *
     * @return Documento[]
     */
    public function buscarDocumentoPendientePorArchivar():array{
        $documentos = DocumentoModel::where('Estado','PENDIENTE')
            ->where('FechaRegistro', '<=', Carbon::now()->subDays(90)) 
            ->get();
        return $documentos->map(function($documentoModel){
            return new Documento($documentoModel->Id, $documentoModel->FechaRegistro);
        })->toArray();
    }

    public function archivarDocumento(Documento $documento): void {
        $documentoModel = DocumentoModel::find($documento->getId());
        $documentoModel->Estado = $documento->getEstado()->value;
        $documentoModel->save();
    }
}