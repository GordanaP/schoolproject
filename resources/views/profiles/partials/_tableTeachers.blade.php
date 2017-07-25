<table class="table admin__table" id="tableTeachers">

    <thead>
        <th class="text-center" width="100px">
            <i class="fa fa-cog"></i>
        </th>
        <th class="text-uppercase">Name</th>
        <th class="text-uppercase">Subjects</th>
    </thead>

    <tbody>
        @forelse ($teachers as $teacher)
        <tr>
            <!-- Action buttons -->
            <td class="text-center flex justify-center"  width="100px">
                <a href="{{ route('profiles.edit', $teacher->user->name) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-pencil-square-o"></i>
                </a>

            </td>

            <!-- Name -->
            <td>
                <a href="{{ route('accounts.edit', $teacher->user->name) }}">
                    {{ $teacher->full_name }}
                </a>
            </td>

            <!-- Subjects -->
            <td>
                Biology, history
            </td>
        </tr>
        @empty
            There are no teachers at this time.
        @endforelse
    </tbody>

</table>

