@if (count($classrooms))

    @component('partials.admin._table')

        @slot('th')
            <th class="text-center" width="100px">
                <i class="fa fa-cog"></i>
            </th>
            <th class="text-uppercase">Name</th>
        @endslot

        @slot('rows')
            @foreach ($classrooms as $classroom)
                @include('classrooms.partials._rowClassroom')
            @endforeach
        @endslot

    @endcomponent

@else
    There are no classrooms at present.
@endif