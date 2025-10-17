<?php

namespace Src\Infraestructura\Repositorios;

use App\Models\Repositorios\WebHook\Documento as DocumentoModel;
use Src\Dominio\WebHook\Entidades\Documento;
use Src\Dominio\WebHook\Enums\EstadoEnum;
use Src\Dominio\WebHook\Interfaces\Repositorios\IDocumentoRepository;

class DocumentoRepository implements IDocumentoRepository {
   
    /**
     * Buscar un documento por su ID.
     *
     * @param mixed $id
     * @return mixed|null
     */
    public function buscarDocumentoPorId($id) :? Documento{

        $documento = DocumentoModel::where('Id', $id)->first();
        return  $documento? new Documento($documento->Id, EstadoEnum::from($documento->Estado)):null;
    }

    /**
     * Actualizar un documento.
     *
     * @param mixed $documento
     * @return bool
     */
    public function actualizarDocumento($documento):void {
        $documentoModel = DocumentoModel::find($documento->getId());
        $documentoModel->Estado = $documento->getEstado()->value;
        $documentoModel->save();

    }
}