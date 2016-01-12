<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FinanceController extends Controller{

    public function index(){
        $students = DB::table('students')
                    ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                    ->select('students.*', 'charge.queueFlag')
                    ->where('charge.queueFlag', '=', '6')
                    ->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.finance_value','>','0')
            ->paginate(15);

         return view('staff/finance', compact('students','pending'));
    }
    public function clear(Request $request){
    	$post = $request->all();
    	$comment = "N/A";
    	$value = $post['amount'];
    	$student = $post['regNo'];
      $magic_val = $post['magic_value'];
        /*
          * NOTE!!!
          * The magic value below is a hidden input that
          * helps in evaluating which type of query is to be executed.
          * */
        if($magic_val == 0){
            DB::update("UPDATE charge INNER JOIN comments
      			ON charge.students_studentNo = comments.students_studentNo  SET comments.finance = '$comment', charge.finance_value = '$value'
      			WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");
        }

            /**
             * Sends mail, but to whom?
             */
//            $admin = DB::table('schools')
//                ->join('administrators','schools.administrator','=','administrators.admin_id')
//                ->select('administrators.email')->where('schools.department_name','=','Games')
//                ->pluck('email');
//            //Send Mail
//            Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
//                $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
//            });

      DB::update("UPDATE charge INNER JOIN comments
			ON charge.students_studentNo = comments.students_studentNo  SET comments.finance = '$comment', charge.finance_value = '$value', charge.queueFlag = '7'
			WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");

		  return redirect('/finance');
    }

    public function update(){
      
    }
}
