<?php

namespace App\Http\Requests\Calendar;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Calendar\Traits\ValidateWorkShiftTrait;

class StoreRequest extends FormRequest
{
    use ValidateWorkShiftTrait;
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
            'event_at' => ['required', 'date'],
            'name' => ['required', 'string', 'max:255'],
            'cost' => ['required', 'integer', 'max:9999999'],
            'company_id' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'work_shift' => ['required', 'integer'],
            'employee_id' => ['required', 'integer'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'company_id' => 'company',
            'event_at' => 'date event',
            'employee_id' => 'manager',
            'work_shift' => 'work shift'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){
           $this->validateWorkShift($validator);
        });
    }


}
