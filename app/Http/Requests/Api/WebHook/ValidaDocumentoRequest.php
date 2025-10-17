<?php

namespace App\Http\Requests\Api\WebHook;

use Illuminate\Foundation\Http\FormRequest;
use Src\Dominio\WebHook\Enums\EstadoEnum;

class ValidaDocumentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'documentoId' => 'required|string',
            'nuevoEstado' => 'required|string|in:'. implode(',', array_map(fn($e) => $e->value, EstadoEnum::cases()))
        ];
    }
}
