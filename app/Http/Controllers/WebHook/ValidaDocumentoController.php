<?php

namespace App\Http\Controllers\WebHook;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebHook\RespuestaWebHookResponse;
use Illuminate\Http\Request;
use Src\Aplicacion\WebHook\Interfaces\Servicios\IWebHookService;

class ValidaDocumentoController extends Controller
{
    
    public function __invoke(Request $request)
    {
        return response()->json(new RespuestaWebHookResponse("Documento validado"), 200);
    }
}
