<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
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
        $rules = ['number' => 'required|numeric|min:1'];

        if ($this->isMethod('post')) {
            $rules['hall_id'] = 'required|exists:halls,id';
        }

        return $rules;
    }
}
