<a href="{{ route('courses.create') }}">
    Thêm
</a>

<table border="1" width="100%" cellpadding="2"  cellspacing="0">
    <tr bgcolor="orange">
        <th>#</th>
        <th>Name</th>
        <th>Created At</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    @foreach($data as $each)
        <tr align="center">
            <td>
                {{ $each->id }}
            </td>
            <td>
                {{ $each->name }}
            </td>
            <td>
                {{ $each->year_created_at }}
            </td>
            <td>
                <a href="{{ route('courses.edit', $each) }}">
                    Edit
                </a>
            </td>
            <td>
{{--                <a href="{{ route('course.destroy', ['course' => $each->id]) }}">--}}
{{--                tắt hơn cột khóa chính phải là id--}}
{{--                <a href="{{ route('course.destroy', $each) }}">--}}
{{--                    Delete--}}
{{--                </a>--}}
                <form action="{{ route('courses.destroy', $each) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button>
                        DELETE
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
