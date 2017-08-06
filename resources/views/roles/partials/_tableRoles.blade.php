@if (count($roles))

    @component('partials.admin._table')

        @slot('th')
            <th class="text-center" width="100px">
                <i class="fa fa-cog"></i>
            </th>
            <th class="text-uppercase">Name</th>
        @endslot

        @slot('rows')
            @foreach ($roles as $role)
                @include('roles.partials._rowRole')
            @endforeach
        @endslot

    @endcomponent

@else
    There are no roles at present.
@endif