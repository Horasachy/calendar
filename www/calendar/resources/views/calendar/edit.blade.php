@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-bold">Edit event: {{$event->name}}</h3>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('calendar.update', ['event' => $event->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Date event') }}</label>
                        <div class="col">
                            <input type="date" name="event_at" value="{{ \Carbon\Carbon::create($event->event_at)->format('Y-m-d') }}" class="form-control @error('event_at') is-invalid @enderror">
                            @error('event_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Name') }}</label>
                        <div class="col">
                            <input type="text" name="name" value="{{ $event->name }}"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Cost') }}</label>
                        <div class="col">
                            <input type="text" name="cost" value="{{ $event->cost }}"
                                   class="form-control @error('cost') is-invalid @enderror">
                            @error('cost')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Type work') }}</label>
                        <div class="col">
                            <input type="text" name="type" value="{{ $event->type }}"
                                   class="form-control @error('type') is-invalid @enderror">
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Manager') }}</label>
                        <div class="col">
                            <select class="form-control @error('employee_id') is-invalid @enderror" name="employee_id">
                                <option value="{{$event->employee_id}}"> {{$event->user->getFullName()}}</option>
                                @foreach($users as $user)
                                    @if($event->employee_id !== $user->id)
                                        <option value="{{$user->id}}"> {{$user->getFullName()}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Company') }}</label>
                        <div class="col">
                            <select class="form-control @error('company_id') is-invalid @enderror" name="company_id">
                                <option value="{{$event->company_id}}"> {{$event->company->name}}</option>
                                @foreach($companies as $company)
                                    @if($event->company_id !== $company->id)
                                        <option value="{{$company->id}}"> {{$company->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Work shift') }}</label>
                        <div class="col">
                            <select class="form-control @error('work_shift') is-invalid @enderror" name="work_shift">
                                <option value="{{\App\Models\CalendarEvent::FIRST_SHIFT}}" @if(App\Models\CalendarEvent::FIRST_SHIFT === $event->work_shift) selected @endif>
                                    FIRST SHIFT
                                </option>
                                <option value="{{\App\Models\CalendarEvent::SECOND_SHIFT}}" @if(App\Models\CalendarEvent::SECOND_SHIFT === $event->work_shift) selected @endif>
                                    SECOND SHIFT
                                </option>
                                <option value="{{\App\Models\CalendarEvent::NIGHT_SHIFT}}" @if(App\Models\CalendarEvent::NIGHT_SHIFT === $event->work_shift) selected @endif>
                                    NIGHT SHIFT
                                </option>
                            </select>
                            @error('work_shift')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
