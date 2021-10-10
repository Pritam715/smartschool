<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\SubjectTopic;
use App\Grade;
use App\Teacher;
use App\Video;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    
    public function index($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $video=Video::where('teacher_id',$teacherid)->latest()->paginate(10);
        return view('backend.video.index',compact('video'));
    }


    public function create($slug)
    {
        $teacher=Teacher::select('id')->where('code_id',$slug)->first();
        $teacherid=$teacher->id;
        $subject=Subject::where('teacher_id',$teacherid)->get();
        $class=Grade::where('teacher_id',$teacherid)->get();
        // $topic=SubjectTopic::where('category_id','3')->where('teacher_id',$teacher->id)->get();
        return view('backend.video.create',compact('subject','class'));
    }


           // find SubjectTopic
           public function findtopic(Request $request){
            $teacher=Teacher::select('id')->where('code_id',$request->slug)->first();
            $teacherid=$teacher->id;
            // $data=Subject::where('teacher_id',$teacherid)->where('id',$request->id)->get();
            $data=SubjectTopic::where('subject_id',$request->id)->where('teacher_id',$teacherid)->where('category_id','2')->get();
            return response()->json($data);//then sent this data to ajax success
           }
    


           public function store(Request $request)
           {
                // dd($request->all());
      
               $request->validate([
                   'teacher_id'        => 'required',
                   'class_id'     => 'required',
                   'subject_id'        => 'required',
                   'title_name' => 'required',
                   'topic_id'=>'required',
                   'link'=>'required',
               
               ]);
   
               $videourl=$request->link;
               if($videourl){
                   preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $videourl, $matches);
                   $video = "https://youtube.com/embed/".$matches[1];
               } else{
                   $video = '';
               }
       
               Video::create([
                   'teacher_id'        => $request->teacher_id,
                   'class_id'     => $request->class_id,
                   'subject_id'        => $request->subject_id,
                   'topic_id' =>  $request->topic_id,
                    'title_name'=> $request->title_name,
                    'link'=>  $video,
                   'slug'=> Str::slug($request->title_name,'-'),
               ]);
       
               return redirect()->route('video.index', $request->teacher_code_id);
   
   
           }


           
        public function edit($id)
        {
            $video=Video::find($id);

            $teacherid=$video->teacher_id;
            $class=Grade::where('teacher_id',$teacherid)->get();
            return view('backend.video.edit',compact('video','class'));
        }


        public function update(Request $request,$id)
        {
            // dd($request->all());
        
             $video=Video::findOrFail($id);
             $video->teacher_id=$request->teacher_id;
             $video->class_id= $request->class_id;
             $video->subject_id=$request->subject_id;
             $video->topic_id= $request->topic_id;
             $video->title_name= $request->title_name;

             $videourl=$request->link;
             if($videourl){
                 preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $videourl, $matches);
                 $videourl = "https://youtube.com/embed/".$matches[1];
             } else{
                 $video = '';
             }
             $video->link=$videourl;
             $video->slug=Str::slug($request->title_name,'-');
             $video->update();

          

            return redirect()->route('video.index', $request->teacher_code_id);
        }


        public function delete($id)
        {
            $video=Video::find($id);
            $video->delete();
            return redirect()->back();
        }
}
