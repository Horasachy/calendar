@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-bold">Create event</h3>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('calendar.store') }}">
                    @csrf
                    @method('post')
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Date event') }}</label>
                        <div class="col">
                            <input type="date" name="event_at" value="{{ old('event_at') }}" class="form-control @error('event_at') is-invalid @enderror">
                            @error('event_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Name') }}</label>
                        <div class="col">
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Cost') }}</label>
                        <div class="col">
                            <input type="text" name="cost" value="{{ old('cost') }}"
                                   class="form-control @error('cost') is-invalid @enderror">
                            @error('cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Type work') }}</label>
                        <div class="col">
                            <input type="text" name="type" value="{{ old('type') }}"
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
                                @foreach($users as $user)
                                    <option value="{{$user->id}}"> {{$user->getFullName()}}</option>
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
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}"> {{$company->name}}</option>
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
                                <option value="{{\App\Models\CalendarEvent::FIRST_SHIFT}}">FIRST SHIFT</option>
                                <option value="{{\App\Models\CalendarEvent::SECOND_SHIFT}}">SECOND SHIFT</option>
                                <option value="{{\App\Models\CalendarEvent::NIGHT_SHIFT}}">NIGHT SHIFT</option>
                            </select>
                            @error('work_shift')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
