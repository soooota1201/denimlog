<?php

namespace App\Http\Requests\DenimRecords;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDenimRecordRequest extends FormRequest
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
            'wearing_day' => 'before:"now"|required',
        ];
    }
}
