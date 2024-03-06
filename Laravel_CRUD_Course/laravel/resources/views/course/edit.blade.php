<form action="{{ route('courses.update', $each) }}" method="post">
    @csrf
    @method('PUT')
    <table>
        <tr align="left">
            <th>Name</th>
        </tr>
        <tr>
            <td>
                <input type="text" name="name" value="{{ $each->name }}">
            </td>
        </tr>
        <tr>
            <td>
                <button>
                    Update
                </button>
            </td>
        </tr>
    </table>
</form>
