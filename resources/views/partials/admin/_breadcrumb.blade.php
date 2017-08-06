<div class="flex align-center justify-between admin__breadcrumb">

    <ol class="breadcrumb">

        <li>
            <a href="{{ route('pages.dashboard') }}" style=" color: #509195">
                <i class=" icon_house"></i>
            </a>
        </li>

        @if (Request::segment(2) == '')
            <li class="active">
                {{ ucfirst(Request::segment(1)) }}
            </li>
        @else
            <li>
                @if (! Request::is('profiles/*') && ! Request::is('accounts/*'))
                    <a href="{{ route(Request::segment(1).'.index') }}" >
                        {{ ucfirst(Request::segment(1)) }}
                    </a>
                @else
                    {{ ucfirst(Request::segment(1)) }}
                @endif
            </li>
        @endif

        @if (Request::segment(2) != '')
            <li class="active">
                {{ Request::segment(3) ? ucfirst(Request::segment(3)) : ucfirst(Request::segment(2)) }}
            </li>
        @endif

    </ol>

</div>

<hr>