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

    //  get signed in admin
    Cas::getCurrentUser();
    $user = session('cas_user');
    $response = file_get_contents('http://testserver.strathmore.edu:8082/dataservice/staff/getStaff/'.$user);
    $staffInformation = json_decode($response, true);

    $message = "Please Attend to the following students Requesting to be cleared";
    $students = DB::table('students')
                 ->join('cleared_by', 'students.studentNo', '=', 'cleared_by.students_studentNo')
                 ->select('students.*', 'cleared_by.extra_curricular_cleared_by')
                 ->where('cleared_by.extra_curricular_cleared_by', '=', 'N/A')
                 ->paginate(10);
         return view('staff/extraCurricularActivities', compact('students', 'staffInformation','message'));
    }
    public function clear(Request $request){
    	$post = $request->all();
    	$comment = "N/A";
    	$value = 0;
    	$student = $post['regNo'];
      $clearedAt = $post['signedAt'];
      $clearedBy = $post['signedBy'];


      DB::beginTransaction();
      $submit = DB::update("UPDATE charge
        INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo
        INNER JOIN cleared_at ON charge.students_studentNo = cleared_at.students_studentNo
        INNER JOIN cleared_by ON charge.students_studentNo = cleared_by.students_studentNo
        SET
        charge.extra_curricular_value = '$value',
        charge.queueFlag = charge.queueFlag + 1,
        comments.extra_curricular = '$comment',
        cleared_at.extra_curricular_cleared_at = '$clearedAt',
        cleared_by.extra_curricular_cleared_by = '$clearedBy'

        WHERE charge.students_studentNo = '$student'
        AND comments.students_studentNo = '$student'
        AND cleared_at.students_studentNo = '$student'
        AND cleared_by.students_studentNo='$student' ");

        if($submit){
          DB::commit();
        }else{
          DB::rollBack();
        }

      // $admin = DB::table('departments')
      //     ->join('administrators','departments.administrator','=','administrators.admin_id')
      //     ->select('administrators.email')->where('departments.department_name','=','Games')
      //     ->pluck('email');
      //
      // //Send Mail
      // Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
      //     $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
      // });


      return redirect('/extraCurricularActivities');
    }
}
