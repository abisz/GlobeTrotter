<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PictureRequest extends Request
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

        $rules =  [
            'title' => 'required',
            'desc' => 'required',
            'image' => 'required|image'
        ];

        if(Request::isMethod('patch')){
            $rules['image']='image';
        }

        return $rules;
    }
}
