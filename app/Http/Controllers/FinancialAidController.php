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

      $appliedStudentsCaf = DB::table('charge')->where('charge.queueFlag', '=', '5')->count();
  		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
        $students = DB::table('students')
                    ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                    ->select('students.*', 'charge.queueFlag')
                    ->where('charge.queueFlag', '=', '5')
                    ->paginate(15);
         return view('staff/financialAid', compact('students', 'userInformation'));
    }

    public function clear(Request $request){
    	$post = $request->all();
    	$comment = $post['lender'];
    	$value = $post['balance'];
    	$student = $post['regNo'];
      $loan = $post['amountTaken'];
      $repaid = $post['amountRepaid'];

      $comment = preg_replace('/[^A-Za-z0-9 _]/','', $comment);
      $value = preg_replace('/[^0-9]/','', $value);
      $loan = preg_replace('/[^0-9]/','', $loan);
      $repaid = preg_replace('/[^0-9]/','', $repaid);

            $admin = DB::table('schools')
                ->join('administrators','schools.administrator','=','administrators.admin_id')
                ->select('administrators.email')->where('schools.department_name','=','Finance')
                ->pluck('email');
            //Send Mail First
            Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
                $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
            });

        $submit = DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo
        SET comments.financial_aid = '$comment',
        comments.loan = '$loan',
        comments.repaid = '$repaid',
        charge.financial_aid_value = '$value',
        charge.queueFlag = '6'
        WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");

        return redirect('/financialAid');
    }
}
