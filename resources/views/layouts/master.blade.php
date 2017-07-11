<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @include('partials.top._head')
    @include('partials.top._links')

    @yield('links')

</head>

<body style="font-family: 'Roboto Slab', serif;">
    <div id="app">

        @include('partials.top._nav')

        <div class="container">
            @yield('master.content')
        </div>
    </div>

     @include('partials.bottom._scripts')
     @yield('scripts')
</body>

</html>
