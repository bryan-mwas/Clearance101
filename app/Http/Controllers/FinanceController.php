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

class FinanceController extends Controller{

    public function index(){

      //  get signed in admin
      Cas::getCurrentUser();
      $user = session('cas_user');
      $response = file_get_contents('http://testserver.strathmore.edu:8082/dataservice/staff/getStaff/'.$user);
      $staffInformation = json_decode($response, true);

      $message  = "Please Attend to the following students Requesting to be cleared";
      $students = DB::table('students')
                   ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                   ->join('cleared_by', 'students.studentNo', '=', 'cleared_by.students_studentNo')
                   ->select('students.*', 'cleared_by.finance_cleared_by')
                   ->where('cleared_by.finance_cleared_by', '=', 'N/A')->where('charge.queueFlag','=','6')
                   ->paginate(10);
      $pending = DB::table('students')
                   ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                   ->select('students.*', 'charge.*')
                   ->where('charge.total','>','0')->where('charge.queueFlag', '=', '7')
                   ->paginate(15);

      return view('staff/finance', compact('students','pending', 'staffInformation','message'));
    }

    public function clear(Request $request){
    	$post      = $request->all();
    	$comment   = "N/A";
    	$value     = $post['amount'];
    	$student   = $post['regNo'];
      $magic_val = $post['magic_value'];
      $clearedAt = $post['signedAt'];
      $clearedBy = $post['signedBy'];


      $comment = preg_replace('/[^A-Za-z0-9 _]/','', $comment);
      $value   = preg_replace('/[^0-9]/','', $value);

      DB::beginTransaction();
      $submit = DB::update("UPDATE charge
        INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo
        INNER JOIN cleared_at ON charge.students_studentNo = cleared_at.students_studentNo
        INNER JOIN cleared_by ON charge.students_studentNo = cleared_by.students_studentNo
        SET
        comments.finance = '$comment',
        charge.finance_value = '$value',
        charge.queueFlag = '7',
        cleared_at.finance_cleared_at = '$clearedAt',
        cleared_by.finance_cleared_by = '$clearedBy'

        WHERE charge.students_studentNo = '$student'
        AND comments.students_studentNo = '$student'
        AND cleared_at.students_studentNo = '$student'
        AND cleared_by.students_studentNo='$student' ");

        if($submit){
          DB::commit();
        }else{
          DB::rollBack();
        }

//            $admin = DB::table('departments')
//                ->join('administrators','departments.administrator','=','administrators.admin_id')
//                ->select('administrators.email')->where('departments.department_name','=','Games')
//                ->pluck('email');
//            //Send Mail
//            Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
//                $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
//            });


		  return redirect('/finance');
    }

    public function update(Request $request){
      $post = $request->all();
      $id = $post['regNo'];
      $school = $post['school'];
      $cafeteria = $post['cafeteria'];
      $library = $post['library'];
      $financialAid = $post['financialAid'];
      $finance = $post['finance'];

      $school = preg_replace('/[^0-9]/','', $school);
      $cafeteria = preg_replace('/[^0-9]/','', $cafeteria);
      $library = preg_replace('/[^0-9]/','', $library);
      $financialAid = preg_replace('/[^0-9]/','', $financialAid);
      $finance = preg_replace('/[^0-9]/','', $finance);

      DB::update("UPDATE charge
          SET
          charge.department_value = charge.department_value - '$school',
          charge.cafeteria_value = charge.cafeteria_value - '$cafeteria',
          charge.library_value = charge.library_value - '$library',
          charge.finance_value = charge.finance_value - '$finance',
          charge.financial_aid_value = charge.financial_aid_value - '$financialAid'
    	WHERE charge.students_studentNo = '$id' ");

      return redirect('/finance');
    }
}
