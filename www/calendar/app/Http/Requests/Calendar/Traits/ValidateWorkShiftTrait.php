<?php
namespace App\Http\Requests\Calendar\Traits;

use App\Models\CalendarEvent;
use Carbon\Carbon;

Trait ValidateWorkShiftTrait {
    public function validateWorkShift($validator)
    {
            foreach (CalendarEvent::get() as $val)
                if ($this->convertDate($this->event_at) == $this->convertDate($val->event_at) &&
                    $this->company_id == $val->company_id &&
                    $this->work_shift == $val->work_shift
                )
                    $validator->errors()->add(
                        'error',
                        'This selected company has a shift already taken'
                    );
    }

    public function convertDate($date)
    {
        return Carbon::create($date)->format('Y-m-d');
    }
}
