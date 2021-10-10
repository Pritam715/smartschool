<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\SubjectTopic;
use App\Grade;
use App\Teacher;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    public function index($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $topic=SubjectTopic::with('subject')->where('teacher_id',$teacherid)->latest()->paginate(10);
        // dd($topic);
        return view('backend.subject_topic.index',compact('topic'));
    }

    public function create($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $subject=Subject::where('teacher_id',$teacherid)->get();
        $class=Grade::where('teacher_id',$teacherid)->get();
        return view('backend.subject_topic.create',compact('subject','class'));
    }
     
    // find Subject
    public function findSubject(Request $request){
        $teacher=Teacher::select('id')->where('code_id',$request->slug)->first();
        $teacherid=$teacher->id;
        // $class=Grade::select('id','teacher_id')->where('')
        $data=Subject::where('teacher_id',$teacherid)->where('class_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
       }



    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'teacher_id'        => 'required',
            'class_id'     => 'required',
            'subject_id'        => 'required',
            'topic_name' => 'required',
            'category_id'=>'required',
        
        ]);

        SubjectTopic::create([
            'teacher_id'        => $request->teacher_id,
            'class_id'     => $request->class_id,
            'subject_id'        => $request->subject_id,
            'topic_name' =>  $request->topic_name,
            'category_id'=> $request->category_id,
            'slug'=> Str::slug($request->topic_name,'-'),
        ]);

        return redirect()->route('topic.index', $request->teacher_code_id);
    }

    public function edit($id)
    {
        
        $topic=SubjectTopic::find($id);
        $teacherid=$topic->teacher_id;
        $subject=Subject::where('teacher_id',   $teacherid)->get();
        $class=Grade::where('teacher_id',   $teacherid)->get();
        return view('backend.subject_topic.edit',compact('topic','subject','class'));
    }



    public function update(Request $request,$id)
    {
        // dd($request->all());
        $topic=SubjectTopic::findOrFail($id);
        $topic->update([
            'teacher_id'        => $request->teacher_id,
            'class_id'     => $request->class_id,
            'subject_id'        => $request->subject_id,
            'topic_name' => $request->topic_name,
            'category_id'=> $request->category_id,
            'slug'=> Str::slug($request->topic_name,'-'),
        ]);
        return redirect()->route('topic.index', $request->teacher_code_id);

    }



    public function delete($id)
    {
       $topic=SubjectTopic::find($id);
       $topic->delete();
       return redirect()->back();
    }
}
