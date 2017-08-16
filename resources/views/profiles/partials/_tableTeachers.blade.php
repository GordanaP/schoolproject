@if (count($teachers))

    @component('partials.admin._table')

        @slot('th')
            <th class="text-center" width="100px">
                <i class="fa fa-cog"></i>
            </th>
            <th class="text-uppercase">Name</th>
            <th class="text-uppercase">Cwid</th>
            <th class="text-uppercase">Date of birth</th>
            <th class="text-uppercase">Group</th>
            <th>
               <i class="icon_lock"></i>
            </th>
        @endslot

        @slot('rows')
            @foreach ($teachers as $teacher)
                @include('profiles.partials._rowTeacher')
            @endforeach
        @endslot

    @endcomponent

@else
    There are no teachers at present.
@endif