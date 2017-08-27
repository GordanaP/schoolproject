<tr>
    <!-- Action buttons -->
    <td class="text-center flex justify-center"  width="100px">
        <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-pencil"></i>
        </a>

        <form action="{{ route('roles.destroy', $role) }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the role?')" >
                <i class="fa fa-trash"></i>
            </button>

        </form>

    </td>

    <!-- Name -->
    <td>
        {{ $role->name }}
    </td>
</tr>