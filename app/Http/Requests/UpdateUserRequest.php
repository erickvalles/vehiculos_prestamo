<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'nombre'=>'required',
            'apaterno'=>'required',
            'amaterno'=>'required',
            'cargo'=>'required',
            'celular'=>'required|numeric',
            'email'=>'required|unique:users,email,'.$this->route('usuario'),
            //'slc_jefe'=>'required'
        ];
    }
}
