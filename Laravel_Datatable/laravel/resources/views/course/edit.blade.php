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
                @if($errors->has('name'))
                    <span class="error">
                        {{ $errors->first('name') }}
                    </span>
                @endif
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
