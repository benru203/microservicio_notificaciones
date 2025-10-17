<?php

namespace App\Http\Resources\WebHook;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RespuestaWebHookResponse extends JsonResource
{
    public string $mensaje;

     public function __construct(string $mensaje)
    {
        $this->mensaje = $mensaje;
        parent::__construct(null);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'mensaje' => $this->mensaje
        ];;
    }
}
