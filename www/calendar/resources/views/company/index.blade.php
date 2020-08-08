@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a class="btn btn-primary" href="{{route('company.create')}}">Create company</a>

            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>{{__('Id')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Employees')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <th>{{$company->id}}</th>
                            <th>{{$company->name}}</th>
                            <th>{{count($company->users)}}</th>
                            <th>
                                <a href="{{route('company.edit', ['company' => $company->id])}}">edit</a>
                                <a href="{{route('company.delete', ['company' => $company->id])}}"
                                   title="{{ __('Delete') }}"
                                   data-type="delete"
                                   data-csrf="{{csrf_token()}}">
                                        delete
                                </a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
@endsection
