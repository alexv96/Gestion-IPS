<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoPerfilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rut_empleado' =>'required|min:10|max:10',
            'nombre' => 'required|min:3|max:25',
            'apellido_paterno' =>'required|min:5|max:20',
            'apellido_materno'=>'max:20',
            'email'=>'required|min:10|max:80|email',
            'contrasena' => 'required|between:4,15',
        ];
    }
}
