<form action="{{ route('courses.store') }}" method="post">
    @csrf
    <table>
        <tr align="left">
            <th>Name</th>
        </tr>
        <tr>
            <td>
                <input type="text" name="name">
            </td>
        </tr>
        <tr>
            <td>
                <button>
                    Thêm
                </button>
            </td>
        </tr>
    </table>
</form>
