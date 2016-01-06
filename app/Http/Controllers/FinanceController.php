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
         * Condition is used to determine the query to be executed.
         * */
        if($magic_val == 0){
            DB::update("UPDATE charge INNER JOIN comments
			ON charge.students_studentNo = comments.students_studentNo  SET comments.finance = '$comment', charge.finance_value = '$value'
			WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");
        }
        elseif($magic_val == 1){
            $submit = DB::update("UPDATE charge INNER JOIN comments
			ON charge.students_studentNo = comments.students_studentNo  SET comments.finance = '$comment', charge.finance_value = '$value', charge.queueFlag = '7'
			WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");

            //Send Mail
            $emails = ['mwathibrian7@gmail.com','brianphiri.9523@gmail.com', 'anamikoye52@gmail.com'];
            Mail::send('mails.clear', ['student' => $student ], function($message) use($emails)
            {
                $message->to($emails)->from('strath.clearance@gmail.com', 'strath')->subject('Clearance');
            });
        }
		return redirect('/finance');
    }
}
