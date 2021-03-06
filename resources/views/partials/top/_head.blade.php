<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name') }} @yield('title')</title>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Icons -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/elegant-icons-style.css') }}">

<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'user' => [
            'name' => Auth::check() ? Auth::user()->name : '',
            'role' => Auth::check() && (Auth::user()->isSuperAdmin() || Auth::user()->isAdmin()) ? 'admin' : '',
        ],
    ]) !!};
</script>