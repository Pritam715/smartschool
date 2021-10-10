<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\SubjectTopic;
use App\Grade;
use App\Teacher;
use App\Pdf;
use Illuminate\Support\Str;

class PdfController extends Controller
{
    public function index($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $pdf=Pdf::where('teacher_id',$teacherid)->latest()->paginate(10);
        return view('backend.pdf.index',compact('pdf'));
    }

    public function create($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $subject=Subject::where('teacher_id',$teacherid)->get();
        $class=Grade::where('teacher_id',$teacherid)->get();
        $topic=SubjectTopic::where('teacher_id',$teacher->id)->where('category_id','1')->get();
        return view('backend.pdf.create',compact('subject','class','topic'));
    }


       // find SubjectTopic
       public function findtopic(Request $request){
        $teacher=Teacher::select('id')->where('code_id',$request->slug)->first();
        $teacherid=$teacher->id;
        // $data=Subject::where('teacher_id',$teacherid)->where('id',$request->id)->get();
        $data=SubjectTopic::where('subject_id',$request->id)->where('teacher_id',$teacherid)->where('category_id','1')->get();
        return response()->json($data);//then sent this data to ajax success
       }


        public function store(Request $request)
        {
            //  dd($request->all());
   
            $request->validate([
                'teacher_id'        => 'required',
                'class_id'     => 'required',
                'subject_id'        => 'required',
                'pdf_name' => 'required',
                'topic_id'=>'required',
                'file_name'=>'required',
            
            ]);

            $file = $request->file('file_name');
            $filename=$file->getClientOriginalName();
            $destinationPath = 'Uploads/Files/Pdf';
            $file->move($destinationPath,$filename);

    
            Pdf::create([
                'teacher_id'        => $request->teacher_id,
                'class_id'     => $request->class_id,
                'subject_id'        => $request->subject_id,
                'topic_id' =>  $request->topic_id,
                 'pdf_name'=> $request->pdf_name,
                 'file_name'=>  $filename,
                'slug'=> Str::slug($request->pdf_name,'-'),
            ]);
    
            return redirect()->route('pdf.index', $request->teacher_code_id);


        }



        public function edit($id)
        {
            $pdf=Pdf::find($id);

            $teacherid=$pdf->teacher_id;
            $class=Grade::where('teacher_id',$teacherid)->get();
            return view('backend.pdf.edit',compact('pdf','class'));
        }


        public function update(Request $request,$id)
        {
            // dd($request->all());
        
             $pdf=Pdf::findOrFail($id);
             $pdf->teacher_id=$request->teacher_id;
             $pdf->class_id= $request->class_id;
             $pdf->subject_id=$request->subject_id;
             $pdf->topic_id= $request->topic_id;
             $pdf->pdf_name= $request->pdf_name;
             if($request->file('file_name'))
             {
             $file = $request->file('file_name');
             $filename=$file->getClientOriginalName();
             $destinationPath = 'Uploads/Files/Pdf';
             $file->move($destinationPath,$filename);
             $pdf->file_name=$filename;
            }
             $pdf->slug=Str::slug($request->pdf_name,'-');
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

            return redirect()->route('pdf.index', $request->teacher_code_id);
        }


        public function delete($id)
        {
            $pdf=Pdf::find($id);
            $pdf->delete();
            return redirect()->back();
        }


}
