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

class LibraryController extends Controller{

    public function index(){
      $user = Auth::user()->regNo;
      $userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

      $appliedStudentsLib = DB::table('charge')->where('charge.queueFlag', '=', '2')->count();
      if($appliedStudentsLib > 0){
        // $message = "Please Attend to the following ( ".$appliedStudentsLib." ) students Requesting to be cleared";
        $message = "Please Attend to the following students Requesting to be cleared";
      }elseif($appliedStudentsLib == 0){
        $message = "No students have requested to be cleared we will notify you using your Email(".$userMail.") when you have students waiting to be cleared";
      }

  		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
        $students = DB::table('students')
                    ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                    ->select('students.*', 'charge.queueFlag')
                    ->where('charge.queueFlag', '=', '2')
                    ->paginate(15);
         return view('staff/library', compact('students','userInformation','message'));
    }
    public function clear(Request $request){
    	$post = $request->all();
    	$comment = $post['comment'];
    	$value = $post['amount'];
    	$student = $post['regNo'];

      $comment = preg_replace('/[^A-Za-z0-9 _]/','', $comment);
      $value = preg_replace('/[^0-9]/','', $value);

            $admin = DB::table('schools')
                ->join('administrators','schools.administrator','=','administrators.admin_id')
                ->select('administrators.email')->where('schools.department_name','=','Extra-curricular')
                ->pluck('email');
            //Send Mail
            Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
                $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
            });

            $submit = DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo  SET comments.library = '$comment', charge.library_value = '$value', charge.queueFlag = '3' WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");


        return redirect('/library');
    }
}
