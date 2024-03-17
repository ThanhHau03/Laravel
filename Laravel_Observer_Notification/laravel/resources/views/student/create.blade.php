{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}

@extends('layout.master')
@section('content')
    <form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <lable>
                Name
            </lable>
            <input type="text" name="name" class="form-control">
            <lable>
                Gender
            </lable>
        </div>
        Genger
        <input type="radio" name="gender" value="1" checked>Nam
        <input type="radio" name="gender" value="0">Nữ
        <br>
        Birthdate
        <input type="date" name="birthdate">
        <br>
        Status
        <br>
        @foreach($arrStudentStatus as $option => $value)
            <input type="radio" name="status" value="{{ $value }}"
                   @if($loop->first)
                       checked
                   @endif
            >
            {{ $option }}
            <br>
        @endforeach
        <br>
        Avatar
        <input type="file" name="avatar" required>
        <br>
        Course
        <select name="course_id">
            @foreach($courses as $course)
                <option value="{{ $course->id }}">
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
        <br>
        <button>
            Create
        </button>
    </form>
@endsection
