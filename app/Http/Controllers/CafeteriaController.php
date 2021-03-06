<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use cas;

class CafeteriaController extends Controller{

    public function index(){
      // $userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

      $message = "Please Attend to the following students Requesting to be cleared";

      // get signed in admin
      // Cas::getCurrentUser();
      // $user = session('cas_user');
      $response = file_get_contents('http://testserver.strathmore.edu:8082/dataservice/staff/getStaff/2214');
   		$staffInformation = json_decode($response, true);

      $students = DB::table('students')
                   ->join('cleared_by', 'students.studentNo', '=', 'cleared_by.students_studentNo')
                   ->select('students.*', 'cleared_by.cafeteria_cleared_by')
                   ->where('cleared_by.cafeteria_cleared_by', '=', 'N/A')->where('cleared_by.department_cleared_by', '!=', 'N/A')
                   ->paginate(10);

      return view('staff/cafeteria', compact('students','staffInformation', 'message'));
    }


    public function clear(Request $request){
    	$post = $request->all();

        $comment = $post['comment'];
        $value = $post['amount'];
        $student = $post['regNo'];
        $clearedAt = $post['signedAt'];
        $clearedBy = $post['signedBy'];


        $comment = preg_replace('/[^A-Za-z0-9 _]/','', $comment);
        $value = preg_replace('/[^0-9]/','', $value);

        DB::beginTransaction();
          $submit = DB::update("UPDATE charge
            INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo
            INNER JOIN cleared_at ON charge.students_studentNo = cleared_at.students_studentNo
            INNER JOIN cleared_by ON charge.students_studentNo = cleared_by.students_studentNo
            SET
            charge.cafeteria_value = '$value',
            charge.queueFlag = charge.queueFlag + 1,
            comments.cafeteria = '$comment',
            cleared_at.cafeteria_cleared_at = '$clearedAt',
            cleared_by.cafeteria_cleared_by = '$clearedBy'

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
        //         ->join('administrators','departments.administrator','=','administrators.admin_id')
        //         ->select('administrators.email')->where('departments.department_name','=','Library')
        //         ->pluck('email');
            //Send Mail
        // Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
        //     $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
        // });

        return redirect('/cafeteria');
    }
}
