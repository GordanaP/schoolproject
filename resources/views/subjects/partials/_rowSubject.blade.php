<tr>
    <!-- Action buttons -->
    <td class="text-center flex justify-center"  width="100px">
        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-pencil"></i>
        </a>

        <form action="{{ route('subjects.destroy', $subject) }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the subject?')" >
                <i class="fa fa-trash"></i>
            </button>

        </form>

    </td>

    <!-- Name -->
    <td>
        <a href="#">
            {{ $subject->name }}
        </a>
    </td>
</tr>