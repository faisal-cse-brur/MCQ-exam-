<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subject;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use App\Models\exams_attempt;
use App\Models\QnaExam;
use App\Imports\QnaImport; 
use App\Models\exams_answers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;


class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('role:superadministrator');
    }
    
    public function index()
    {
        return view('admin.index');
    }   

     public function addSubject(Request $request)
    {
    	 return view('admin.pages.add_subject');
    }
     public function showSubject(Request $request)
    {
    	$subject=subject::all();
    	return response()->json([
    		'subject'=>$subject,
    	]);

    	// return view('admin.pages.add_subject');
    }
 	public function storeSubject(Request $request)
    {
    	try {
    		$sub= new subject;
    		$sub->subject=$request->subject;
    		$sub->save();
    
    		return response()->json(['success'=>true,'msg'=>'Subject added']);
    		
    	} catch (\Exception $e) {
    		return response()->json(['success'=>false,'msg'=>$e->getMessage()]);	
    	}
    	
    }

    public function editSubject($id){
    	$subject=subject::find($id);
    	if ($subject) {
    		return response()->json([
    			'status'=>200,
    			'subject'=>$subject,
    		]);
    	}else{
    		return response()->json([
    		'status'=>404,
    		'subject'=>'subject not found',
    		]);
    	}

    }
     public function updateSubject(Request $request,$id){
         $subject=subject::find($id);
        if ($subject) {
            $subject->subject=$request->subject;
            $subject->update();

            return response()->json([
                'status'=>200,
                'subject'=>$subject,
            ]);
        }else{
            return response()->json([
            'status'=>404,
            'subject'=>'subject not found',
            ]);
        }
    }
    public function deleteSubject($id) {
       $subject=subject::find($id);
       $subject->delete();
       return response()->json([
            'status'=>202,
            'subject'=>'subject delete successfull',
            ]);
    }


     public function addExam(Request $request)
    {
         return view('admin.pages.add_exam');
    }
    public function showExam(Request $request)
    {

        $subjects=subject::all();
        $all_exam=Exam::with('subjects_method')->get();
//From Model
        return response()->json([
            'exam'=>$all_exam,
        ]);

        // return view('admin.pages.add_subject');
    }
    public function storeExam(Request $request)
    {
        try {
            $unique_id =uniqid('exmid');

            $sub= new Exam; 
            $sub->exam_name=$request->exam_name;
            $sub->enterance_id=$unique_id;
            $sub->subject_id =$request->subject_id;
            $sub->date =$request->date;
            $sub->time =$request->time;
            $sub->attempt =$request->attempt;
            $sub->save();
    
            return response()->json(['success'=>true,'msg'=>'Exam added']);
            
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
        
    }
    public function deleteExam($id) {
       $exam=Exam::find($id);
       $exam->delete();
       return response()->json([
            'status'=>202,
            'exam'=>'Exam delete successfull',
            ]);
    }

    public function loadmarks()
    {

        $exam=Exam::with('getQnaExam')->get();
       return response()->json([
            'exam'=>$exam,
        ]);
    }

     public function viewmarks()
    {
        return view('admin.pages.marksDeshboard');
    }
     public function editMarks($id){
        $marks=Exam::find($id);
        if ($marks) {
            return response()->json([
                'status'=>200,
                'marks'=>$marks,
            ]);
        }else{
            return response()->json([
            'status'=>404,
            'marks'=>'marks not found',
            ]);
        }

    }
    //  public function updateMarks(Request $request,$id){
    //      $subject=subject::find($id);
    //     if ($subject) {
    //         $subject->subject=$request->subject;
    //         $subject->update();

    //         return response()->json([
    //             'status'=>200,
    //             'subject'=>$subject,
    //         ]);
    //     }else{
    //         return response()->json([
    //         'status'=>404,
    //         'subject'=>'subject not found',
    //         ]);
    //     }
    // }
    public function showreviewexam(){
       return view('admin.pages.exam_review'); 
    }
   
    public function examReview()
    {
      $attempt= exams_attempt::with(['user','exam'])->orderBy('id')->get();
      return response()->json([
            'attempt'=>$attempt,
        ]);
    } 

     public function reviewqna(Request $request,$id)
    {
         try {
             $attemptData= exams_answers::where('attempt_id',$id)->with('question','answers')->get();

              return response()->json([
                    'attemptData'=>$attemptData,
                    'status'=>true,
                    'msg'=>'Successfull'
                ]);
            
        } catch (\Exception $e) {
            return response()->json(['status'=>false,'msg'=>$e->getMessage()]);    
        }
    }

   public function approvedQna(Request $request)
    {
       try {
            $attempt_id=$request->attempt_id;
            $examdata = exams_attempt::where('id',$attempt_id)->with('exam')->get();

            $marks=$examdata[0]['exam']['marks'];
            $Negative=$examdata[0]['exam']['negativeMarks'];

           $attemptData= exams_answers::where('attempt_id',$attempt_id)->with('answers')->get();

           $PosativeMarks=0;
           $NagativeMarks=0;


           if(count($attemptData)>0){
            foreach ($attemptData as $attempt) {
                if ($attempt->answers->is_correct==1) {
                    $PosativeMarks+=$marks;
                }
                if ($attempt->answers->is_correct==0) {
                    $NagativeMarks+=$Negative;
                }
            }
           }

           $totalMarks=$PosativeMarks-$NagativeMarks;

           exams_attempt::where('id',$attempt_id)->update([
            'status'=>1,
            'marks'=>$totalMarks,
           ]);

            return response()->json(['success'=>true,'msg'=>'Approved successfully', 'data'=>$attemptData]);
            
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }

    public function addQuestion(Request $request)
    {
         return view('admin.pages.add_question_answer');
    }
    public function showQuestion(Request $request)
    {
        $questions=Question::with('answers_method')->get();
//From Model
        return response()->json([
            'questions'=>$questions,
        ]);

        // return view('admin.pages.add_subject');
    }
    public function storeQuestion(Request $request)
    {
        try {
            $questionId= Question::insertGetId([
                'question'=>$request->question,
                'institude'=>$request->institude
            ]);
            
            foreach ($request->answers as $answer) {

                $is_correct=0;
                if($request->is_correct==$answer){
                    $is_correct=1;
                }
                Answer::insert([
                    'question_id'=>$questionId,
                    'answer'=>$answer,
                    'is_correct'=>$is_correct,
                ]);
            }
    
            return response()->json(['success'=>true,'msg'=>'Exam added']);
            
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
        // return response()->json($request->all());
        
    }
    public function deleteQuestion($id) {
       $Question=Question::find($id);
       $Question->delete();
       return response()->json([
            'status'=>202,
            'Question'=>'Question delete successfull',
            ]);
    }

     public function getQuestionDetails(Request $request){
        $qna=Question::where('id',$request->qid)->with('answers_method')->get();
        return response()->json(['data'=>$qna]);

    }
     public function deleteAnswer(Request $request){
        Answer::where('id',$request->id)->delete();
        return response()->json(['success'=>true, 'msg'=>'Answer deleted successfully']);
    }

     public function updateQnA(Request $request){
          try {
           Question::where('id',$request->question_id)->update([
            'question'=>$request->question
           ]);

        if(isset($request->answers_method)){
            foreach ($request->answers_method as $key => $value) {
                $is_correct=0;
                if($request->is_correct==$value){
                    $is_correct=1;
                }

                Answer::where('id',$key)
                ->update([
                    'question_id'=>$request->question_id,
                    'answer'=>$value,
                    'is_correct'=>$is_correct
                ]);
            }
           }
           // New Answer Added

            if(isset($request->new_answers)){

            foreach ($request->new_answers as $key => $answer) {
                    $edit_is_checked=0;
                if($request->edit_is_checked==$answer){
                    $edit_is_checked=1;
                }

                Answer::insert([
                    'question_id'=>$request->question_id,
                    'answer'=>$answer,
                    'is_correct'=>$edit_is_checked
                ]);
                
            }
           }
            return response()->json(['success'=>true,'msg'=>'Q&A added successfully']); 
            
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }

    public function deleteQna($id) {
         try {
            Question::find($id)->delete();
            Answer::find($id)->delete();
            return response()->json(['success'=>true, 'msg'=>'Q&A deleted successfully']);
         
           } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }

    public function importQna(Request $request)
    {
         try {
            Excel::import(new QnaImport, $request->file('file'));
            return response()->json(['success'=>true, 'msg'=>'Q&A Import successfully']);
         
           } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }


    public function StudentIndex(Request $request)
    {
         return view('admin.pages.studentsDeshbord');
    }
    public function studentsDeshbord(Request $request)
    {
        $users = User::whereRoleIs('user')->get();

        return response()->json([
            'student'=>$users,
        ]);
    }

    public function addStudent(Request $request)
    {
         try {
            $posword = Str::random(8);
            // dd($posword);
            User::insert([

                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($posword),
            ]);
            
            
            $url= URL::to('/');
            $data['url'] = $url;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            // $data['password'] = $password;
            $data['title']="Student Registration on Online Exam System";

            Mail::send('auth.registrationMail',['data'=>$data],function($message) use($data){
                $message->to($data['email'])->subject($data['title']);
            });


            return response()->json(['success'=>true, 'msg'=>'Student added successfully']);
         
           } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }

    public function getQuestions(Request $request){
        try{
            $questions=Question::all();
            if(count($questions)>0){
                $data=[];
                $counter=0;
                foreach ($questions as  $question) {
                   $qnaExam= QnaExam::where(['exam_id'=>$request->exam_id,'question_id'=>$question->id])->get();
                   
                   if (count($qnaExam)==0) {
                       $data[$counter]['id']=$question->id;
                       $data[$counter]['questions']=$question->question;
                        $data[$counter]['institudes']=$question->institude;
                       $counter++;
                   }
                }
                return response()->json(['success'=>true, 'msg'=>'Question data','data'=>$data]);

            }else{
                return response()->json(['success'=>false, 'msg'=>'Question not found']);
            }

        }catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }

    public function addQuestions(Request $request){
        try{
            if (isset($request->questions_ids)) {
                foreach ($request->questions_ids as $qid) {
                    QnaExam::insert([

                        'exam_id'=>$request->exam_id,
                        'question_id'=>$qid
                    ]);                
                }
            }
             return response()->json(['success'=>true, 'msg'=>'Question added successfully']);

        }catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }
    public function getExamQuestions(Request $request)
    {
        try{

            $data = QnaExam::where('exam_id',$request->exam_id)->with('question')->get();
            return response()->json(['success'=>true, 'msg'=>'Question deteils!','data'=>$data]);

        }catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }
    public function deleteExamQuestions(Request $request)
    {
        try{

        QnaExam::where('id',$request->id)->delete();
            return response()->json(['success'=>true, 'msg'=>'Question delete Successfull!']);

        }catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);    
        }
    }
}
