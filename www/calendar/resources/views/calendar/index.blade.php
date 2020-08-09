@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{route('calendar.create')}}">Create event</a>
            </div>
            <div class="col-md-12 mt-3">
                <label>Select company</label>
                <select name="status" id="" onChange="window.location.href=this.value"
                        class="form-control form-control-sm">
                    @foreach($companies as $company)
                        <option value="{{ route('calendar.index',[
                                    'company_id' => $company->id,
                                    'month' => $filters['month'],
                                    'year' => $filters['year']
                                    ]) }}"
                                @if($company->id == $filters['company_id']) selected @endif>
                            {{$company->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <label>Select month</label>
                <select name="status" id="" onChange="window.location.href=this.value"
                        class="form-control form-control-sm">
                    @foreach($months as $month)
                        <option value="{{ route('calendar.index',[
                                    'company_id' => $filters['company_id'],
                                    'month' => $month->id,
                                    'year' => $filters['year']
                                    ]) }}"
                                @if($month->id == $filters['month']) selected @endif>
                            {{$month->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <label>Select year</label>
                <select name="status" id="" onChange="window.location.href=this.value"
                        class="form-control form-control-sm">
                    @foreach(range(1950, now()->year) as $year)
                        <option value="{{ route('calendar.index',[
                                    'company_id' => $filters['company_id'],
                                    'month' => $filters['month'],
                                    'year' => $year
                                    ]) }}"
                                @if($year == $filters['year']) selected @endif>
                            {{$year}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-3" style="overflow: scroll;">
                <table class="calendar-table">
                    @foreach($days as $day)
                        <thead>
                            <tr class="calendar-tr">
                                <th class="calendar-th-month"> </th>
                                <th class="calendar-th">{{\Carbon\Carbon::create($filters['year'], $filters['month'], $day)->format('Y-m-d')}}</th>
                            </tr>
                        </thead>
                        <tbody class="calendar-tbody">
                            <tr class="calendar-tr">
                                <th class="calendar-th">First shift</th>
                                @foreach($events as $event)
                                    @if($event->work_shift === \App\Models\CalendarEvent::FIRST_SHIFT &&
                                       \Carbon\Carbon::create($event->event_at)->format('d') == $day)
                                        <td class="calendar-td">
                                            <div class="calendar-div">
                                                <b>{{$event->name}}</b><br>
                                                {{$event->cost}}<br>
                                                {{$event->type}}<br>
                                                {{$event->user->getFullName()}}<br>
                                                <a href="{{route('calendar.edit', ['event' => $event->id , 'company_id' => $filters['company_id']])}}">edit</a>
                                                <a href="{{route('calendar.delete', ['event' => $event->id])}}"
                                                   title="{{ __('Delete') }}"
                                                   data-type="delete"
                                                   data-csrf="{{csrf_token()}}">
                                                    delete
                                                </a>
                                            </div>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr class="calendar-tr">
                                <th class="calendar-th">Second shift</th>
                                @foreach($events as $event)
                                    @if($event->work_shift === \App\Models\CalendarEvent::SECOND_SHIFT &&
                                      \Carbon\Carbon::create($event->event_at)->format('d') == $day)
                                        <td class="calendar-td">
                                            <div class="calendar-div">
                                                <b>{{$event->name}}</b><br>
                                                {{$event->cost}}<br>
                                                {{$event->type}}<br>
                                                {{$event->user->getFullName()}}<br>
                                                <a href="{{route('calendar.edit', ['event' => $event->id, 'company_id' => $filters['company_id']])}}">edit</a>
                                                <a href="{{route('calendar.delete', ['event' => $event->id])}}"
                                                   title="{{ __('Delete') }}"
                                                   data-type="delete"
                                                   data-csrf="{{csrf_token()}}">
                                                    delete
                                                </a>
                                            </div>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr class="calendar-tr">
                                <th class="calendar-th">Night shift</th>
                                @foreach($events as $event)
                                    @if($event->work_shift === \App\Models\CalendarEvent::NIGHT_SHIFT &&
                                    \Carbon\Carbon::create($event->event_at)->format('d') == $day)
                                        <td class="calendar-td">
                                            <div class="calendar-div">
                                                <b>{{$event->name}}</b><br>
                                                {{$event->cost}}<br>
                                                {{$event->type}}<br>
                                                {{$event->user->getFullName()}}<br>
                                                <a href="{{route('calendar.edit', ['event' => $event->id, 'company_id' => $filters['company_id']])}}">edit</a>
                                                <a href="{{route('calendar.delete', ['event' => $event->id])}}"
                                                   title="{{ __('Delete') }}"
                                                   data-type="delete"
                                                   data-csrf="{{csrf_token()}}">
                                                    delete
                                                </a>
                                            </div>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
