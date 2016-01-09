<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExtraCurricularActivitiesController extends Controller{
   public function index(){
        $students = DB::table('students')
                    ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                    ->select('students.*', 'charge.queueFlag')
                    ->where('charge.queueFlag', '=', '3')
                    ->paginate(15);
        $pending = DB::table('students')
           ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
           ->select('students.*', 'charge.*')
           ->where('charge.extra_curricular_value','>','0')
           ->paginate(15);

         return view('staff/extraCurricularActivities', compact('students','pending'));
    }
    public function clear(Request $request){
    	$post = $request->all();
    	$comment = "N/A";
    	$value = 0;
    	$student = $post['regNo'];
        $magic_val = $post['magic_value'];
        /*
         * NOTE!!!
         * The magic value below is a hidden input that
         * helps in evaluating which type of query is to be executed.
         * */
        if($magic_val == 0){
            DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo  SET comments.extra_curricular = '$comment', charge.extra_curricular_value = '$value' WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");
        }
        elseif($magic_val == 1){
            $submit = DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo  SET comments.extra_curricular = '$comment', charge.extra_curricular_value = '$value', charge.queueFlag = '4' WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");

            $admin = DB::table('schools')
                ->join('administrators','schools.administrator','=','administrators.admin_id')
                ->select('administrators.email')->where('schools.department_name','=','Games')
                ->pluck('email');
            //Send Mail
            Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
                $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
            });
        }

        return redirect('/extraCurricularActivities');
    }
}
