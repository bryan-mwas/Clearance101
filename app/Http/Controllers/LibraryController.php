<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LibraryController extends Controller{

    public function index(){
        $students = DB::table('students')
                    ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                    ->select('students.*', 'charge.queueFlag')
                    ->where('charge.queueFlag', '=', '2')
                    ->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.library_value','>','0')
            ->paginate(15);
        
         return view('staff/library', compact('students','pending'));
    }
    public function clear(Request $request){
    	$post = $request->all();
    	$comment = $post['comment'];
    	$value = $post['amount'];
    	$student = $post['regNo'];
        /*
         * NOTE!!!
         * The magic value below is a hidden input that
         * helps in evaluating which type of query is to be executed.
         * */

        $magic_val = $post['magic_value'];

        if($magic_val == 0){
            DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo  SET comments.library = '$comment', charge.library_value = '$value' WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");
        }
        elseif($magic_val == 1){

            $admin = DB::table('schools')
                ->join('administrators','schools.administrator','=','administrators.admin_id')
                ->select('administrators.email')->where('schools.department_name','=','Extra-curricular')
                ->pluck('email');
            //Send Mail
            Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
                $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
            });

            $submit = DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo  SET comments.library = '$comment', charge.library_value = '$value', charge.queueFlag = '3' WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");

        }

        return redirect('/library');
    }
}
