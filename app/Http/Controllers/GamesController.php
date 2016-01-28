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

class GamesController extends Controller{

  public function index(){
    $user = Auth::user()->regNo;
    $userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

    $appliedStudentsGam = DB::table('charge')->where('charge.queueFlag', '=', '1')->count();
    if($appliedStudentsGam > 0){
      $message = "Please Attend to the following ( ".$appliedStudentsGam." ) students Requesting to be cleared";
      // $message = "Please Attend to the following students Requesting to be cleared";
    }elseif($appliedStudentsGam == 0){
      $message = "No students have requested to be cleared we will notify you using your Email(".$userMail.") when you have students waiting to be cleared";
    }

		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
    $students = DB::table('students')
                 ->join('cleared_by', 'students.studentNo', '=', 'cleared_by.students_studentNo')
                 ->select('students.*', 'cleared_by.games_cleared_by')
                 ->where('cleared_by.games_cleared_by', '=', 'N/A')
                 ->paginate(10);

         return view('staff/games', compact('students','userInformation','message'));
    }
    public function clear(Request $request){
    	$post = $request->all();
    	$comment = "N/A";
    	$value = 0;
    	$student = $post['regNo'];
      $clearedAt = $post['signedAt'];
      $clearedBy = $post['signedBy'];


      DB::beginTransaction();
      $submit = DB::update("UPDATE charge
        INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo
        INNER JOIN cleared_at ON charge.students_studentNo = cleared_at.students_studentNo
        INNER JOIN cleared_by ON charge.students_studentNo = cleared_by.students_studentNo
        SET
        charge.games_value = '$value',
        comments.games = '$comment',
        cleared_at.games_cleared_at = '$clearedAt',
        cleared_by.games_cleared_by = '$clearedBy'

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
            ->select('administrators.email')->where('departments.department_name','=','Financial Aid')
            ->pluck('email');

            //Send Mail
            Mail::send('mails.clear', ['student' => $student ], function($message) use($admin){
                $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
            });
        return redirect('/games');
    }
}
