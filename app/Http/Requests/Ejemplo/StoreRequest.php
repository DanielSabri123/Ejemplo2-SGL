<?php

namespace App\Http\Requests\Ejemplo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            "Datos.nombre"=> "required|regex:/^[a-zA-Z'.\\s.\\d._.!.¡.?.¿.{.}.$.^.-.'.+.*.&.%.#,°,=.ñ.Ñ]{1,250}$/",
            "Datos.descripcion"=> "required|regex:/^[a-zA-Z'.\\s.\\d._.!.¡.?.¿.{.}.$.^.-.'.+.*.&.%.#,°,=.ñ.Ñ]{1,250}$/"
        ];
    }

    public function messages()
    {
        return[
            "Datos.nombre.required" => "Se necesita ingresar un nombre",
            "Datos.nombre.min" => "Se necesitan mínimo 5 caracteres",
            "Datos.nombre.regex" => "El nombre introducido contiene carácteres no permitidos. Algunos de los carácteres permitidos son _ ! ¡ ? ¿ { } $ ^ - ' + * & % # ° =",
            "Datos.descripcion.required" => "Se necesita ingresar una descripción",
            "Datos.descripcion.regex" => "La descripción introducido contiene carácteres no permitidos. Algunos de los carácteres permitidos son _ ! ¡ ? ¿ { } $ ^ - ' + * & % # ° =",
        ];
    }
}
