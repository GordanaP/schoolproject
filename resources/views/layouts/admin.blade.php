<!DOCTYPE html>
<html lang="en">
  <head>

    @include('partials.top._head')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css">

    @yield('links')

    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

  </head>

  <body>

    @include('partials.admin._nav')

    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">

                    @include('partials.admin._side')

                </div>

                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
    @include('partials.bottom._scripts')
    @yield('scripts')

    </body>
</html>
