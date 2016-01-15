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


class CafeteriaController extends Controller{
    public function index(){
        $user = Auth::user()->regNo;
        $userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
        $students = DB::table('students')
                     ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                     ->select('students.*', 'charge.queueFlag')
                     ->where('charge.queueFlag', '=', '1')
                     ->paginate(10);
         return view('staff/cafeteria', compact('students','userInformation'));
        // return $userInformation;
    }



    public function clear(Request $request){
    	$post = $request->all();

        $comment = $post['comment'];
        $value = $post['amount'];
        $student = $post['regNo'];

        $submit = DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo  SET comments.cafeteria = '$comment', charge.cafeteria_value = '$value', charge.queueFlag = '2' WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");
        $admin = DB::table('schools')
                ->join('administrators','schools.administrator','=','administrators.admin_id')
                ->select('administrators.email')->where('schools.department_name','=','Library')
                ->pluck('email');
            //Send Mail
        Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
            $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
        });

        return redirect('/cafeteria');
    }
}
