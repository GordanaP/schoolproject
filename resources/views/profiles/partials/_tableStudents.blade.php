@if (count($students))

    @component('partials.admin._table')

        @slot('th')
            <th class="text-center" width="100px">
                <i class="fa fa-cog"></i>
            </th>
            <th class="text-uppercase">Name</th>
            <th class="text-uppercase">Cwid</th>
            <th class="text-uppercase">Date of birth</th>
            <th class="text-uppercase">Group</th>
            <th class="text-uppercase"><i class="fa fa-lock"></i></th>
        @endslot

        @slot('rows')
            @foreach ($students as $value => $student)
                @include('profiles.partials._rowStudent')
            @endforeach
        @endslot

    @endcomponent

@else
    There are no students at present.
@endif
