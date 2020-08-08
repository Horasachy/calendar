<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:companies'],
            'employee_id' => ['array'],
            'company_id' => ['integer', 'required'],
        ];
    }

    public function attributes()
    {
        return [
            'employee_id' => 'employees',
            'company_id' => 'company',
        ];
    }
}
