<?php

namespace App\Http\Requests\Ejemplo;

use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
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
            "Datos.Id_Ejemplo" => "required",
        ];
    }

    public function messages()
    {
        return[
            "Datos.Id_Ejemplo.required" => "No se recibió ningún identificador",
        ];
    }
}
