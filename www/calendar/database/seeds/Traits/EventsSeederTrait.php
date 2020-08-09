<?php

namespace seeds\Traits;

use App\Models\CalendarEvent;
use App\Models\Company;


/**
 * Trait CompanySeederTrait
 * @package seeds\Traits
 */
trait EventsSeederTrait
{

    /**
     * @param $user
     */
    private function createEvents($user)
    {
        echo "Create events\n";
        factory(CalendarEvent::class, 2)->make()
            ->each(function ($item) use ($user) {
                $item->employee_id = $user->id;
                $item->save();
            });

    }
}
