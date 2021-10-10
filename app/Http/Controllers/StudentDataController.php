<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use App\Terminal;
use App\SubjectTopic;
use App\Pdf;
use App\ImpQ;
use App\Video;

class StudentDataController extends Controller
{
    
    //Pdf

    public function Pdfsubject($slug)
    {
        $student=Student::where('code_id',$slug)->first();
        $class_id=$student->class_id;
        $subjects=Subject::where('class_id',$class_id)->get();

       return view('studentdata.pdf.subject',compact('subjects'));
    }
    public function Pdfsubjecttopic($id)
    {
      
        $subject=Subject::where('id',$id)->first();
        $topic=SubjectTopic::where('subject_id',$id)->where('category_id','1')->latest()->paginate();
        return view('studentdata.pdf.pdftopic',compact('topic','subject'));

    }

    public function Pdffile($id)
    {
        $topic=SubjectTopic::where('id',$id)->first();
        $pdf=Pdf::where('topic_id',$id)->latest()->paginate();
        return view('studentdata.pdf.file',compact('pdf','topic'));

    }


    //Terminal Paper

    
    public function Terminalsubject($slug)
    {
        $student=Student::where('code_id',$slug)->first();
        $class_id=$student->class_id;
        $subjects=Subject::where('class_id',$class_id)->get();

       return view('studentdata.terminal_paper.subject',compact('subjects'));
    }
    public function Terminalsubjecttopic($id)
    {
      
        $subject=Subject::where('id',$id)->first();
        $topic=SubjectTopic::where('subject_id',$id)->where('category_id','3')->latest()->paginate();
        return view('studentdata.terminal_paper.terminaltopic',compact('topic','subject'));

    }

    public function Terminalfile($id)
    {
        $topic=SubjectTopic::where('id',$id)->first();
        $terminal=Terminal::where('topic_id',$id)->latest()->paginate();
        // dd($terminal);
        return view('studentdata.terminal_paper.file',compact('terminal','topic'));

    }



    //Important Question Paper

    public function Importantsubject($slug)
    {
        $student=Student::where('code_id',$slug)->first();
        $class_id=$student->class_id;
        $subjects=Subject::where('class_id',$class_id)->get();

       return view('studentdata.important_question.subject',compact('subjects'));
    }
    public function Importantsubjecttopic($id)
    {
      
        $subject=Subject::where('id',$id)->first();
        $topic=SubjectTopic::where('subject_id',$id)->where('category_id','4')->latest()->paginate();
        return view('studentdata.important_question.importanttopic',compact('topic','subject'));

    }

    public function Importantfile($id)
    {
    
      
        $topic=SubjectTopic::where('id',$id)->first();
        $important=ImpQ::where('topic_id',$id)->latest()->paginate();
       
        return view('studentdata.important_question.file',compact('important','topic'));

    }


     //Video

     public function Videosubject($slug)
     {
         $student=Student::where('code_id',$slug)->first();
         $class_id=$student->class_id;
         $subjects=Subject::where('class_id',$class_id)->get();
 
        return view('studentdata.video.subject',compact('subjects'));
     }
     public function Videosubjecttopic($id)
     {
       
         $subject=Subject::where('id',$id)->first();
         $topic=SubjectTopic::where('subject_id',$id)->where('category_id','2')->latest()->paginate();
         return view('studentdata.video.videotopic',compact('topic','subject'));
 
     }
 
     public function Videofile($id)
     {
     
       
         $topic=SubjectTopic::where('id',$id)->first();
         $video=Video::where('topic_id',$id)->latest()->paginate();
        
         return view('studentdata.video.video',compact('video','topic'));
 
     }
}
