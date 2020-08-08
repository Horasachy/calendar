<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CalendarEvent
 * @package App\Models
 */
class CalendarEvent extends Model
{
    const FIRST_SHIFT = 0;
    const SECOND_SHIFT = 1;
    const NIGHT_SHIFT = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cost', 'type', 'employee_id', 'work_shift'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function company()
    {
        return $this->belongsToMany(Company::class, 'company_events', 'event_id', 'company_id');
    }
}
