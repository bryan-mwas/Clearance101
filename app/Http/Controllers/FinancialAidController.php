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

class FinancialAidController extends Controller{

    public function index(){
      $user = Auth::user()->regNo;
      $userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');
      $message = "Please Attend to the following students Requesting to be cleared";

      $appliedStudentsCaf = DB::table('charge')->where('charge.queueFlag', '=', '5')->count();
  		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
      $students = DB::table('students')
                   ->join('cleared_by', 'students.studentNo', '=', 'cleared_by.students_studentNo')
                   ->select('students.*', 'cleared_by.financial_aid_cleared_by')
                   ->where('cleared_by.financial_aid_cleared_by', '=', 'N/A')
                   ->paginate(10);
         return view('staff/financialAid', compact('students', 'userInformation', 'message'));
    }

    public function clear(Request $request){
    	$post = $request->all();
    	$comment = $post['lender'];
    	// $value = $post['balance'];
    	$student = $post['regNo'];
      $loan = $post['amountTaken'];
      $repaid = $post['amountRepaid'];
      $clearedAt = $post['signedAt'];
      $clearedBy = $post['signedBy'];


      $comment = preg_replace('/[^A-Za-z0-9 _]/','', $comment);
      $value = preg_replace('/[^0-9]/','', $value);
      $loan = preg_replace('/[^0-9]/','', $loan);
      $repaid = preg_replace('/[^0-9]/','', $repaid);

      $value = $loan - $repaid;

      DB::beginTransaction();
      $submit = DB::update("UPDATE charge
        INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo
        INNER JOIN cleared_at ON charge.students_studentNo = cleared_at.students_studentNo
        INNER JOIN cleared_by ON charge.students_studentNo = cleared_by.students_studentNo
        SET
        charge.financial_aid_value = '$value',
        charge.queueFlag = charge.queueFlag + 1,
        comments.financial_aid = '$comment',
        comments.loan = '$loan',
        comments.repaid = '$repaid',
        cleared_at.financial_aid_cleared_at = '$clearedAt',
        cleared_by.financial_aid_cleared_by = '$clearedBy'

        WHERE charge.students_studentNo = '$student'
        AND comments.students_studentNo = '$student'
        AND cleared_at.students_studentNo = '$student'
        AND cleared_by.students_studentNo='$student' ");

        if($submit){
          DB::commit();
        }else{
          DB::rollBack();
        }

        $admin = DB::table('departments')
            ->join('administrators','departments.administrator','=','administrators.admin_id')
            ->select('administrators.email')->where('departments.department_name','=','Finance')
            ->pluck('email');
        //Send Mail First
        Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
            $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
        });

        return redirect('/financialAid');
    }
}
