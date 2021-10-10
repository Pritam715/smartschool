<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\SubjectTopic;
use App\Grade;
use App\Teacher;
use App\Terminal;
use Illuminate\Support\Str;

class TerminalController extends Controller
{
    
    public function index($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $terminal=Terminal::where('teacher_id',$teacherid)->latest()->paginate(10);
        return view('backend.terminal_question.index',compact('terminal'));
    }


    public function create($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $subject=Subject::where('teacher_id',$teacherid)->get();
        $class=Grade::where('teacher_id',$teacherid)->get();
        // $topic=SubjectTopic::where('category_id','3')->where('teacher_id',$teacher->id)->get();
        return view('backend.terminal_question.create',compact('subject','class'));
    }


           // find SubjectTopic
           public function findtopic(Request $request){
            $teacher=Teacher::select('id')->where('code_id',$request->slug)->first();
            $teacherid=$teacher->id;
            // $data=Subject::where('teacher_id',$teacherid)->where('id',$request->id)->get();
            $data=SubjectTopic::where('subject_id',$request->id)->where('teacher_id',$teacherid)->where('category_id','3')->get();
            return response()->json($data);//then sent this data to ajax success
           }
    


           public function store(Request $request)
           {
                // dd($request->all());
      
               $request->validate([
                   'teacher_id'        => 'required',
                   'class_id'     => 'required',
                   'subject_id'        => 'required',
                   'paper_name' => 'required',
                   'topic_id'=>'required',
                   'file_name'=>'required',
               
               ]);
   
               $file = $request->file('file_name');
               $filename=$file->getClientOriginalName();
               $destinationPath = 'Uploads/Files/TerminalQuestion';
               $file->move($destinationPath,$filename);
   
       
               Terminal::create([
                   'teacher_id'        => $request->teacher_id,
                   'class_id'     => $request->class_id,
                   'subject_id'        => $request->subject_id,
                   'topic_id' =>  $request->topic_id,
                    'paper_name'=> $request->paper_name,
                    'file_name'=>  $filename,
                   'slug'=> Str::slug($request->pdf_name,'-'),
               ]);
       
               return redirect()->route('terminal.index', $request->teacher_code_id);
   
   
           }


           
        public function edit($id)
        {
            $terminal=Terminal::find($id);

            $teacherid=$terminal->teacher_id;
            $class=Grade::where('teacher_id',$teacherid)->get();
            return view('backend.terminal_question.edit',compact('terminal','class'));
        }


        public function update(Request $request,$id)
        {
            // dd($request->all());
        
             $terminal=Terminal::findOrFail($id);
             $terminal->teacher_id=$request->teacher_id;
             $terminal->class_id= $request->class_id;
             $terminal->subject_id=$request->subject_id;
             $terminal->topic_id= $request->topic_id;
             $terminal->paper_name= $request->paper_name;
             if($request->file('file_name'))
             {
             $file = $request->file('file_name');
             $filename=$file->getClientOriginalName();
             $destinationPath = 'Uploads/Files/Pdf';
             $file->move($destinationPath,$filename);
             $terminal->file_name=$filename;
            }
             $terminal->slug=Str::slug($request->paper_name,'-');
             $terminal->update();

            //   $pdf->update([
            //     'teacher_id'        => $request->teacher_id,
            //     'class_id'     => $request->class_id,
            //     'subject_id'        => $request->subject_id,
            //     'topic_id' =>  $request->topic_id,
            //      'pdf_name'=> $request->pdf_name,
            //      'file_name'=>  $filename,
            //     'slug'=> Str::slug($request->pdf_name,'-'),
            // ]);

            return redirect()->route('terminal.index', $request->teacher_code_id);
        }


        public function delete($id)
        {
            $terminal=Terminal::find($id);
            $terminal->delete();
            return redirect()->back();
        }
}
