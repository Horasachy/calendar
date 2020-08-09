<?php

namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class BuilderRequest extends FormRequest
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
            'company_id' => ['integer'],
            'month' => ['integer'],
            'year' => ['integer']
        ];
    }

    /**
     * Default values for search
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'company_id' => $this->input('company_id', 1),
            'month' => $this->input('month', now()->month),
            'year' => $this->input('year', now()->year),
        ]);
    }
}
