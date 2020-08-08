<?php

namespace App\Http\Controllers;

use App\Http\Requests\Calendar\StoreRequest;
use App\Http\Requests\Calendar\UpdateRequest;
use App\Models\CalendarEvent;
use App\Models\Company;
use App\Models\User;

/**
 * Class CalendarEventsController
 * @package App\Http\Controllers
 */
class CalendarEventsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('calendar/index');
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
     * @return array
     */
    public function returnData($event = null)
    {
        return [
            'users' => User::get(),
            'companies' => Company::get(),
            'event' => $event
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

        return redirect()->route('calendar.index');
    }

    /**
     * @param CalendarEvent $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CalendarEvent $event)
    {
        return view('calendar.edit', $this->returnData($event));
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
        return redirect()->route('calendar.index');
    }
}
