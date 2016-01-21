<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExtraCurricularActivitiesController extends Controller{
   public function index(){
     $user = Auth::user()->regNo;
     $userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

     $appliedStudentsExa = DB::table('charge')->where('charge.queueFlag', '=', '3')->count();

     if($appliedStudentsExa > 0){
       $message = "Please Attend to the following ( ".$appliedStudentsExa." ) students Requesting to be cleared";
     }elseif($appliedStudentsExa == 0){
       $message = "No students have requested to be cleared we will notify you using your Email(".$userMail.") when you have students waiting to be cleared";
     }

 		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
        $students = DB::table('students')
                    ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                    ->select('students.*', 'charge.queueFlag')
                    ->where('charge.queueFlag', '=', '3')
                    ->paginate(15);
         return view('staff/extraCurricularActivities', compact('students', 'userInformation','message'));
    }
    public function clear(Request $request){
    	$post = $request->all();
    	$comment = "N/A";
    	$value = 0;
    	$student = $post['regNo'];

            $submit = DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo  SET comments.extra_curricular = '$comment', charge.extra_curricular_value = '$value', charge.queueFlag = '4' WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");

            $admin = DB::table('schools')
                ->join('administrators','schools.administrator','=','administrators.admin_id')
                ->select('administrators.email')->where('schools.department_name','=','Games')
                ->pluck('email');
            //Send Mail
            Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
                $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
            });


        return redirect('/extraCurricularActivities');
    }
}
