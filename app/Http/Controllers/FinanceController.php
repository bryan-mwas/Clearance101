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
            ->where('charge.total','>','0')
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

    public function update(Request $request){
      $post = $request->all();
      $id = $post['regNo'];
      $school = $post['school'];
      $cafeteria = $post['cafetria'];
      $library = $post['library'];
      $financialAid = $post['financialAid'];
      $finance = $post['finance'];

      if($school == '' || $school = null ){
        $school = 0;
      }
      if($cafeteria == '' || $cafeteria = null ){
        $cafeteria = 0;
      }
      if($library == '' || $library = null ){
        $library = 0;
      }
      if($financialAid == '' || $financialAid = null ){
        $financialAid = 0;
      }
      if($finance == '' || $finance = null ){
        $finance = 0;
      }
          DB::update("UPDATE charge
             SET department_value = '$school',
             charge.cafeteria_value = charge.cafeteria_value - '$cafeteria',
             charge.library_value = charge.library_value - '$library',
             charge.finance_value = charge.finance_value - '$finance',
             charge.financial_aid_value = charge.financial_aid_value - '$financialAid'
    			WHERE charge.students_studentNo = '$id' ");

          // UPDATE charge SET financial_aid_value = financial_aid_value - 200;

      return redirect('/finance');
    }
}
