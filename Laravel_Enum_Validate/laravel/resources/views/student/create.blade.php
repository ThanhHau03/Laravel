{{--@if($errors->has('name'))
                        <span class="error">
                            {{ $errors->first('name') }}
                        </span>
                    @endif--}}
@extends('layout.master')
@section('content')
    <form action="{{ route('students.store') }}" method="post">
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
        <input type="radio" name="gender" value="0" checked>Nam
        <input type="radio" name="gender" value="1">Nữ
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
