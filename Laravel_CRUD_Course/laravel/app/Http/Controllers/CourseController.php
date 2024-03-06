<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $data = Course::get();
        return view('course.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(Request $request)
    {
        $object = new Course();
//        $object->fill($request->all());
//        $object->fill($request->except('_token'));
//        $object->save();

//        query builder
        Course::create($request->except('_token'));
        return redirect()->route('courses.index');
    }

    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {
//        $course = Course::where('id', $course)->first();
//        $course = Course::find($course);
        return view('course.edit', [
            'each' => $course
        ]);
    }

    public function update(Request $request, Course $course)
    {
//        Course::where('id', $course->id)->update($request->except([
//            '_token',
//            '_method',
//        ]));

//        query builder
//        course->fill($request->except('_token'));
//        course->save();

        $course->update($request->except([
            '_token',
            '_method',
        ]));

        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
//        Course::destroy($course);
//        Course::where('id', $course)->delete();

//        Course::destroy($course->id);
        $course->delete();
        return redirect()->route('courses.index');
    }
}
