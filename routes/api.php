<?php

use App\Http\Controllers\WebHook\ValidaDocumentoController;
use Illuminate\Support\Facades\Route;


Route::post('webhook/validar-documento', ValidaDocumentoController::class);

