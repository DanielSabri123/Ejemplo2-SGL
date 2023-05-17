<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "Nombre" => "required|min:5",
            "Descripcion"=> "required"
        ];
    }

    public function messages()
    {
        return[
            "Nombre.required" => "Se necesita ingresar un nombre",
            "Nombre.min" => "Se necesitan mínimo 5 caracteres",
            "Descripciom.required" => "Se necesita ingresar una descripción",
        ];
    }
}
