<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class CafeteriaController extends Controller{
    public function index(){
        $name = 'Brian Mwathi';
        $students = DB::table('students')
                     ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                     ->select('students.*', 'charge.queueFlag')
                     ->where('charge.queueFlag', '=', '1')
                     ->paginate(15);
        $pending = DB::table('students')
                            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
                            ->select('students.*', 'charge.*')
                            ->where('charge.cafeteria_value','>','0')
                            ->paginate(15);
         return view('staff/cafeteria', compact('students','pending','name'));

    }

    public function clear(Request $request){
    	$post = $request->all();

        $comment = $post['comment'];
        $value = $post['amount'];
        $student = $post['regNo'];
        $submit = DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo  SET comments.cafeteria = '$comment', charge.cafeteria_value = '$value', charge.queueFlag = '2' WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");
            
        //Send Mail
        $emails = ['mwathibrian7@gmail.com','brianphiri.9523@gmail.com', 'anamikoye52@gmail.com'];
        Mail::send('mails.clear', ['student' => $student ], function($message) use($emails){
            $message->to($emails)->from('strath.clearance@gmail.com', 'strath')->subject('Clearance');
        });
             
        return redirect('/cafeteria');	
    }
}
