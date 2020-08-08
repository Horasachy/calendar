@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-bold">Edit company: {{$company->name}}</h3>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('company.update', ['company' => $company->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Name') }}</label>
                        <div class="col">
                            <input type="text" name="name" value="{{ $company->name }}"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" value="{{$company->id}}" name="company_id">

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">{{ __('Employees') }}</label>
                        <div class="dropdown col" data-control="checkbox-dropdown">
                            <label class="dropdown-label form-control @error('employee_id') is-invalid @enderror"></label>
                            <div class="dropdown-list">
                                <a href="#" data-toggle="check-all" class="dropdown-option">
                                    {{ __('Check everything') }}
                                </a>
                                @foreach($users as $user)
                                    <label class="dropdown-option">
                                        <input type="checkbox" value="{{$user->id}}" name="employee_id[]" @if(in_array($user->id, $checked_employees))checked @endif>
                                        {{$user->getFullName()}}
                                    </label>
                                @endforeach
                            </div>
                            @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
