<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoseRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');
        $data = Course::query()
            ->where('name', 'like', '%' . $search . '%')
            ->paginate(2);

        $data->appends(['q' => $search]);

        return view('course.index', [
            'data' => $data,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(StoseRequest $request)
    {
        $object = new Course();
//        $object->fill($request->all());
//        $object->fill($request->except('_token'));
//        $object->save();

//        query builder
//        Course::create($request->except('_token'));
        Course::create($request->validated());

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

    public function update(UpdateRequest $request, Course $course)
    {
//        Course::where('id', $course->id)->update($request->except([
//            '_token',
//            '_method',
//        ]));

//        query builder
//        course->fill($request->except('_token'));
//        course->save();

//        $course->update($request->except([
//            '_token',
//            '_method',
//        ]));

        $course->fill($request->validated());
        $course->save();

        return redirect()->route('courses.index');
    }

    public function destroy(DestroyRequest $request, $course)
    {
//        Course::where('id', $course)->delete();

//        Course::destroy($course->id);
//        $course->delete();

        Course::destroy($course);
        return redirect()->route('courses.index');
    }
}
