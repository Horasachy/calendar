<?php

namespace App\Http\Controllers;

use App\Http\Builders\CalendarBuilder as Builder;
use App\Http\Requests\Calendar\BuilderRequest;
use App\Http\Requests\Calendar\StoreRequest;
use App\Http\Requests\Calendar\UpdateRequest;
use App\Models\CalendarEvent;
use App\Models\Company;
use App\Models\CompanyEvent;
use App\Models\User;
use App\Models\Month;
use Carbon\Carbon;

/**
 * Class CalendarEventsController
 * @package App\Http\Controllers
 */
class CalendarEventsController extends Controller
{
    /**
     * @param BuilderRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(BuilderRequest $request)
    {
        return view('calendar/index', [
            'events' => (new Builder($request->all()))->get(),
            'companies' => Company::get(),
            'days' => range(0, date('t', mktime(0, 0, 0, $request->month))),
            'filters' => $request->all(),
            'months' => Month::get()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('calendar.create', $this->returnData());
    }

    /**
     * @param null $event
     * @param null $company_id
     * @return array
     */
    public function returnData($event = null , $company_id = null)
    {

        return [
            'users' => User::get(),
            'companies' => Company::get(),
            'event' => $event,
            'company' => Company::find($company_id)
        ];
    }

    /**
     * @param CalendarEvent $event
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CalendarEvent $event, StoreRequest $request)
    {
        $event->fill($request->all());
        $event->save();
        $this->createCompanyEvent($this->mergeEventId($request->all(), CalendarEvent::latest()->first()->id));

        return redirect()->route('calendar.index');
    }


    /**
     * @param CalendarEvent $event
     * @param $company_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CalendarEvent $event, $company_id)
    {
        return view('calendar.edit', $this->returnData($event, $company_id));
    }

    /**
     * @param CalendarEvent $event
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CalendarEvent $event, UpdateRequest $request)
    {
        $event->fill($request->all());
        $event->update();
        $this->deleteCompanyEvent($event);
        $this->createCompanyEvent($request->all());

        return redirect()->route('calendar.index');
    }

    /**
     * @param CalendarEvent $event
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(CalendarEvent $event)
    {
        $event->delete();
        $this->deleteCompanyEvent($event);
        return redirect()->route('calendar.index');
    }

    /**
     * @param $inputs
     */
    public function createCompanyEvent($inputs)
    {
        $companyEvent = new CompanyEvent;
        $companyEvent->fill($inputs);
        $companyEvent->save();
    }

    /**
     * @param $event
     */
    public function deleteCompanyEvent($event)
    {
        CompanyEvent::where('event_id', $event->id)->delete();
    }

    /**
     * @param array $inputs
     * @param string $event_id
     * @return array
     */
    private function mergeEventId(array $inputs, string $event_id)
    {
        return array_merge($inputs, ['event_id' => $event_id]);
    }
}
