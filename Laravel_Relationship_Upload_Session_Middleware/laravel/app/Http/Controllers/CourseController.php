<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoseRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    private Builder $model;

    public function __construct()
    {
        $this->model = (new Course())->query();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);

        View::share('title', $title);
    }

    public function index()
    {
        return view('course.index');
    }

    public function api()
    {
        return Datatables::of($this->model->withCount('students'))
            ->editColumn('created_at', function($object) {
                return $object->year_created_at;
            })
//            ->addColumn('edit', function($object) {
//                $link = route('courses.edit', $object);
//                return "<a class='btn btn-primary' href='$link'> Edit </a>";
//            }) ->rawColumns(['edit]);
            ->addColumn('edit', function($object) {
                return route('courses.edit', $object);
            })
            ->addColumn('destroy', function($object) {
                return route('courses.destroy', $object);
            })
            ->make(true);

//        nên sài thư viện
//        $data = $this->model
//            ->paginate(1, ['*'], 'page', $request->get('draw'));
//        $arr = [];
//        $arr['draw'] = $data->currentPage();
//        $arr['data'] = $data->items();
//
//        foreach ($data as $item) {
//            $item->setAppends([
//                'year_created_at'
//            ]);
//            $item->edit = route('courses.edit', $item);
//            $item->destroy = route('courses.destroy', $item);
//
//            $arr['data'][] = $item;
//        }
//
//        $arr['recordsTotal'] = $data->total();
//        $arr['recordsFiltered'] = $data->total();
//        return $arr;
    }

    public function apiName(Request $request)
    {
        return $this->model
            ->where('name', 'like', '%' . $request->get('q') . '%')
            ->get([
            'id',
            'name',
        ]);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(StoseRequest $request)
    {
//        $object = new Course();
//        $object->fill($request->all());
//        $object->fill($request->except('_token'));
//        $object->save();

//        query builder
//        Course::create($request->except('_token'));
        $this->model->create($request->validated());

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

    public function update(UpdateRequest $request, $courseID)
    {
//        Validated
//        Course::query()
//            ->where('id', $courseID)
//            ->where('user', auth()->id)
//            ->firstOrFail();

//        $this->model->where('id', $courseID)->update($request->validated());

//        $this->model->update($request->validated());

        $object = $this->model->find($courseID);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('courses.index');
    }

    public function destroy(DestroyRequest $request, $courseID)
    {
        $this->model->where('id', $courseID)->delete();
//        $this->model->find($courseID)->delete();
//        $this->model->find($courseID)->destroy($courseID);

        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
