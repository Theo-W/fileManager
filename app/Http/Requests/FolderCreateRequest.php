<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FolderCreateRequest extends FormRequest
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
            'parent' => 'nullable|regex:/^[0-9a-zA-Z_\-\/]+$/',
            'name' => 'nullable|regex:/^[0-9a-zA-Z_\-]+$/'
        ];
    }
}
