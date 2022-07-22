<?php

namespace App\Http\Requests;

use App\Models\CatastroData;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class PriceRequest extends FormRequest
{
    /**
     * @author Kareem Lorenzana
     * @created 2022-07-22
     * @params
     * @desc Determine if the user is authorized to make this request.
     * @return array
     */
    public function authorize()
    {
        if(!in_array(request()->route("aggregate"), CatastroData::AGGREGATE)){
            throw new AuthorizationException('El tipo de consulta o "aggregate" no esta dentro de los parametros permitidos');
        }
        return true;
    }

    /**
     * @author Kareem Lorenzana
     * @created 2022-07-22
     * @params
     * @desc Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'construction_type'=> [
                'required',
                Rule::in(CatastroData::CONSTRUCTION_USES)
            ]
        ];
    }

    public function messages(){
        return [
            'construction_type.required' => 'El uso de contruccion es un parametro requerido',
            'construction_type.in' => 'El uso de contruccion no está dentro del rango permitido'
        ];
    }
}
