@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a class="btn btn-primary" href="{{route('calendar.create')}}">Create event</a>
        </div>
    </div>
@endsection
