<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Teacher;
use App\Grade;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('grade')->latest()->paginate(10);
        // dd($subjects);
        return view('backend.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::latest()->get();

        return view('backend.subjects.create', compact('teachers'));
    }

    //findClass
    public function findclass(Request $request)
    {
        $data=Grade::where('teacher_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'name'          => 'required|string|max:255|unique:subjects',
            'name'          => 'required|string|max:255',
            'subject_code'  => 'required|numeric',
            'class_id'    => 'required|numeric',
            'teacher_id'    => 'required|numeric',
            'description'   => 'required|string|max:255'
        ]);

        Subject::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'subject_code'  => $request->subject_code,
            'class_id'      =>$request->class_id,
            'teacher_id'    => $request->teacher_id,
            'description'   => $request->description
        ]);

        return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject=Subject::where('id',$id)->first();
        $class_id=$subject->class_id;
        $class=Grade::select('id','class_name')->where('id',$class_id)->first();
        $teachers = Teacher::latest()->get();

        return view('backend.subjects.edit', compact('subject','teachers','class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'          => 'required|string|max:255,name,'.$subject->id,
            'subject_code'  => 'required|numeric',
            'class_id'    => 'required|numeric',
            'teacher_id'    => 'required|numeric',
            'description'   => 'required|string|max:255'
        ]);

        $subject->update([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'subject_code'  => $request->subject_code,
            'class_id'      =>$request->class_id,
            'teacher_id'    => $request->teacher_id,
            'description'   => $request->description
        ]);

        return redirect()->route('subject.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return back();
    }
}
