<?php

namespace seeds\Traits;
use App\Models\CalendarEvent;
use App\Models\Company;
use App\Models\CompanyEvent;



/**
 * Trait CompanyEventsSeederTrait
 * @package seeds\Traits
 */
trait CompanyEventsSeederTrait
{


    private function createCompanyEvents()
    {
        echo "Create company events\n";
        factory(CompanyEvent::class, 100)->make()
            ->each(function ($item) {
                $item->company_id = Company::get()->random(1)->pluck('id')[0];
                $item->event_id = CalendarEvent::get()->random(1)->pluck('id')[0];
                $item->save();
            });
    }
}
