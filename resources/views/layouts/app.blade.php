@extends('layouts.master')

@section('plain.content')

    <div class="row">
        <div class="col-md-3">
            Sidebar
        </div>

        <div class="col-md-9">
            @yield('content')
        </div>
    </div>

@endsection