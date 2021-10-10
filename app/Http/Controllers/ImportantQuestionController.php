<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\SubjectTopic;
use App\Grade;
use App\Teacher;
use App\ImpQ;
use Illuminate\Support\Str;

class ImportantQuestionController extends Controller
{
    public function index($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $important=ImpQ::where('teacher_id',$teacherid)->latest()->paginate(10);
        return view('backend.important_question.index',compact('important'));
    }


    public function create($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $subject=Subject::where('teacher_id',$teacherid)->get();
        $class=Grade::where('teacher_id',$teacherid)->get();
        // $topic=SubjectTopic::where('category_id','3')->where('teacher_id',$teacher->id)->get();
        return view('backend.important_question.create',compact('subject','class'));
    }


           // find SubjectTopic
           public function findtopic(Request $request){
            $teacher=Teacher::select('id')->where('code_id',$request->slug)->first();
            $teacherid=$teacher->id;
            // $data=Subject::where('teacher_id',$teacherid)->where('id',$request->id)->get();
            $data=SubjectTopic::where('subject_id',$request->id)->where('teacher_id',$teacherid)->where('category_id','4')->get();
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
               $destinationPath = 'Uploads/Files/ImportantQuestion';
               $file->move($destinationPath,$filename);
   
       
               ImpQ::create([
                   'teacher_id'        => $request->teacher_id,
                   'class_id'     => $request->class_id,
                   'subject_id'        => $request->subject_id,
                   'topic_id' =>  $request->topic_id,
                    'paper_name'=> $request->paper_name,
                    'file_name'=>  $filename,
                   'slug'=> Str::slug($request->paper_name,'-'),
               ]);
       
               return redirect()->route('important.index', $request->teacher_code_id);
   
   
           }


           
        public function edit($id)
        {
            $important=ImpQ::find($id);

            $teacherid=$important->teacher_id;
            $class=Grade::where('teacher_id',$teacherid)->get();
            return view('backend.important_question.edit',compact('important','class'));
        }


        public function update(Request $request,$id)
        {
            // dd($request->all());
        
             $pdf=ImpQ::findOrFail($id);
             $pdf->teacher_id=$request->teacher_id;
             $pdf->class_id= $request->class_id;
             $pdf->subject_id=$request->subject_id;
             $pdf->topic_id= $request->topic_id;
             $pdf->paper_name= $request->paper_name;
             if($request->file('file_name'))
             {
             $file = $request->file('file_name');
             $filename=$file->getClientOriginalName();
             $destinationPath = 'Uploads/Files/Pdf';
             $file->move($destinationPath,$filename);
             $pdf->file_name=$filename;
            }
             $pdf->slug=Str::slug($request->paper_name,'-');
             $pdf->update();

            //   $pdf->update([
            //     'teacher_id'        => $request->teacher_id,
            //     'class_id'     => $request->class_id,
            //     'subject_id'        => $request->subject_id,
            //     'topic_id' =>  $request->topic_id,
            //      'pdf_name'=> $request->pdf_name,
            //      'file_name'=>  $filename,
            //     'slug'=> Str::slug($request->pdf_name,'-'),
            // ]);

            return redirect()->route('important.index', $request->teacher_code_id);
        }


        public function delete($id)
        {
            $important=ImpQ::find($id);
            $important->delete();
            return redirect()->back();
        }
}
