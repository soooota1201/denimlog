<?php

namespace App\Http\Requests\Denims;

use Illuminate\Foundation\Http\FormRequest;

class CreateDenimRequest extends FormRequest
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
            'bland_type' => 'required',
            'waist' => 'integer|digits:2',
            'wearing_count' => 'integer',
            'denim_record_image' = 'required'
        ];
    }
}
