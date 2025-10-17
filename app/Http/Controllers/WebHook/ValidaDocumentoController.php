<?php

namespace App\Http\Controllers\WebHook;

use App\Exceptions\Api\WebHook\DocumentoNotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WebHook\ValidaDocumentoRequest;
use App\Http\Resources\WebHook\RespuestaWebHookResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Aplicacion\WebHook\DTOs\DocumentoDTO;
use Src\Aplicacion\WebHook\Interfaces\Servicios\IWebHookService;

class ValidaDocumentoController extends Controller
{
    
    public function __construct(private IWebHookService $webHookService){}

    public function __invoke(ValidaDocumentoRequest $request)
    {
        try{
            
            $data = $request->all();
            $this->webHookService->actualizarEstado(new DocumentoDTO($data['documentoId'], $data['nuevoEstado']));
            return response()->json(new RespuestaWebHookResponse("Documento validado"), Response::HTTP_OK);

        }catch(DocumentoNotFound $e){
            return response()->json(new RespuestaWebHookResponse($e->getMessage()), Response::HTTP_NOT_FOUND);
        }catch(Exception $e){
            return response()->json(new RespuestaWebHookResponse("Error al procesar la solicitud"), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
