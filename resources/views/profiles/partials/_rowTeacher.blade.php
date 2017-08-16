<tr>
    <!-- Action buttons -->
    <td class="text-center flex justify-center"  width="100px">
        <a href="{{ route('profiles.edit', $teacher->user->name) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-pencil-square-o"></i>
        </a>

        <form action="{{ route('accounts.destroy', $teacher->user->name) }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the account?')">
                <i class="fa fa-trash"></i>
            </button>

        </form>

    </td>

    <!-- Name -->
    <td>
        <a href="{{ route('profiles.show', $teacher->user->name) }}">
            {{ $teacher->full_name }}
        </a>
    </td>

    <!-- Cwid -->
    <td>
        {{ $teacher->cwid }}
    </td>

    <!-- Date of birth -->
    <td>
        {{ $teacher->dob->format('Y-m-d') }}
    </td>

    <!-- Subjects -->
    <td>
        Biology, history
    </td>

    <!-- Reset password -->
    <td>
        <a href="" id="editPassword" data-id="{{ $teacher->user->name }}" data-dob="{{ dob($teacher->dob) }}" data-toggle="modal" data-target="#passwordModal">
            Reset password
        </a>
    </td>
</tr>