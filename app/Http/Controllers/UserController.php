<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam; 
use App\Models\subject;
use App\Models\QnaExam;
use App\Models\exams_answers;
use App\Models\exams_attempt;
use Illuminate\Support\Facades\Auth;
use PDF;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('role:user|superadministrator');
    }
    public function index()
    {
        return view('user.index');
    }
    public function StudentExam()
    {
    	return view('user.exam');
    }
    public function subject(Request $request)
    {
         return view('user.subject.subject');
    }
     public function AllSubject(Request $request)
    {
        $subject=subject::all();
        return response()->json([
            'subject'=>$subject,
        ]);
    }
    public function chepter(Request $request)
    {
         return view('user.subject.chepter');
    }
    public function showchepter(Request $request)
    {
        try{
           $chepter=Exam::with('subjects_method')->orderBy('date')->get();
            
        // Exam::where('subject_id',$request->id)->get();
            // die($request->id);
           
           // return view ('user.subject.chepter', compact('chepter'))->render();
           return response()->json(['success'=>true,'chepter'=>$chepter]);
           // {{ $chepter }}

        }catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }

    public function Showexamlist(Request $request){

    }

    public function examDeshbord($id)
    {
        $qnaExam=Exam::where('enterance_id',$id)->with('getQnaExam')->get();
        if (count($qnaExam)>0) {
            
            if($qnaExam[0]['date'] == date('Y-m-d')){
                
                if (count($qnaExam[0]['getQnaExam'])>0) {

                   $qna= QnaExam::where('exam_id',$qnaExam[0]['id'])->with('question','answers')->inRandomOrder()->limit(3)->get();
                   //die($qna);
                   return view('user.subject.examDeshbord',['success'=>true,'exam'=>$qnaExam,'qna'=>$qna]); 
                }
                else{
                     return view('user.subject.examDeshbord',['success'=>false,'msg'=>'This exam is not available for now','exam'=>$qnaExam]);
                }
            }
            else if($qnaExam[0]['date'] > date('Y-m-d')){
                return view('user.subject.examDeshbord',['success'=>false,'msg'=>'this exam will be start on '.$qnaExam[0]['date'],'exam'=>$qnaExam]);
            }
            else{
              return view('user.subject.examDeshbord',['success'=>false,'msg'=>'This exam has been expired on '.$qnaExam[0]['date'],'exam'=>$qnaExam]);  
            }

        }else{
            return 'Not Found';
        }
    }

    public function examSubmit(Request $request)
    {
        
       $attempt_id= exams_attempt::insertGetId([
            'exam_id'=>$request->exam_id,
            'user_id'=>Auth::user()->id
        ]);
        $qcount= count($request->q);
        if ($qcount>0) {
          for ($i=0; $i <$qcount ; $i++) { 
              if (!empty($request->input('ans_'.($i+1)))) {
                exams_answers::insert([
                'attempt_id'=>$attempt_id,
                'question_id'=>$request->q[$i],
                'answer_id'=>request()->input('ans_'.($i+1)),
               ]);
              }
          }
        }
        return view('user.thankyou');
    }
    
    public function pdfroutine(Request $request)
    {

        $exams=Exam::where('subject_id',$request->id)->get();
        $pdf = PDF::loadView('user.pdfroutine',compact('exams'));
        return $pdf->download('pdf_file.pdf');
    }
     public function routine(Request $request)
    {
        return view('user.indexroutine');
    }
}
