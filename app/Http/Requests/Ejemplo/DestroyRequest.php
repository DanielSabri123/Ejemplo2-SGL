<?php

namespace App\Http\Requests\Ejemplo;

use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "Datos" => "required|array",
        ];
    }

    public function messages()
    {
        return[
            "Datos.required" => "No se recibió ningún identificador",
            "Datos.array" => "No se recibió un arreglo",
        ];
    }
}
