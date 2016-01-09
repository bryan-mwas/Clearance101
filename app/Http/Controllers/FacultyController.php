<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class FacultyController extends Controller{
	public function facultyInformationTechnology(){
        $name = 'FACULTY OF INFORMATION TECHNOLOGY';
        $title = 'FIT';
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'FIT')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.department_value','>','0')
            ->where('students.faculty','=','FIT')
            ->paginate(15);
        return view('staff/faculty', compact('name','title','students','pending'));
    }
  /* display students in SOA */
	public function schoolofAccountancy(){
        $name = 'SCHOOL OF ACCOUNTANCY';
        $title = 'SOA';
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SOA')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.department_value','>','0')
            ->where('students.faculty','=','SOA')
            ->paginate(15);
        return view('staff/faculty', compact('name','title','students','pending'));
	}
  /*DISPLAY students in sfae*/
	public function schoolOfFinanceAndAppliedEconomics(){
        $name = 'SCHOOL OF FINANCE AND APPLIED ECONOMICS';
        $title = 'SFAE';
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SFAE')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.department_value','>','0')
            ->where('students.faculty','=','SFAE')
            ->paginate(15);
        return view('staff/faculty', compact('name','title','students','pending'));
	}
   /*display students in SHSS*/
	public function schoolOfHumanitiesAndSocialSciences(){
        $name = 'SCHOOL OF HUMANITIES AND SOCIAL SCIENCES';
        $title = 'SHSS';
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SHSS')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.department_value','>','0')
            ->where('students.faculty','=','SHSS')
            ->paginate(15);
        return view('staff/faculty', compact('name','title','students','pending'));
	}
        
   /*display students in SMC*/
	public function schoolOfManagementAndCommerce(){
        $name = 'SCHOOL OF MANAGEMENT AND COMMERCE';
        $title = 'SMC';
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SMC')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.department_value','>','0')
            ->where('students.faculty','=','SMC')
            ->paginate(15);
        return view('staff/faculty', compact('name','title','students','pending'));
	}
        
    /* display student is SBS */
	public function strathmoreBusinessSchool(){
        $name = 'STRATHMORE BUSSINESS SCHOOL';
        $title = 'SBS';
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SBS')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.department_value','>','0')
            ->where('students.faculty','=','SBS')
            ->paginate(15);
        return view('staff/faculty', compact('name','title','students','pending'));
	}
        
      /*display sls students */
	public function strathmoreLawSchool(){
        $name = 'STRATHMORE LAW SCHOOL';
        $title = 'FIT';
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SLS')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.department_value','>','0')
            ->where('students.faculty','=','SLS')
            ->paginate(15);
        return view('staff/faculty', compact('name','title','students','pending'));
	}
        
      /*display students is CTH*/
	public function centreForTourismAndHospitality(){
        $name = 'CENTER FOR TOURISIM AND HOSPITALITY';
        $title = 'CTH';
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'CTH')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        $pending = DB::table('students')
            ->join('charge', 'students.studentNo', '=', 'charge.students_studentNo')
            ->select('students.*', 'charge.*')
            ->where('charge.department_value','>','0')
            ->where('students.faculty','=','CTH')
            ->paginate(15);
        return view('staff/faculty', compact('name','title','students','pending'));
	}

	/*clear off student*/
	 public function clear(Request $request){
        $post = $request->all();
        $std = $post['regNo'];
        $clear = array(
            'students_studentNo' => $post['regNo'],
            'department_value'         => $post['amount'],
            'queueFlag'          => '1',
            );

        $com = array(
            'students_studentNo' => $post['regNo'],
            'department'         => $post['comment'],
        );

        $status = array(
            'students_studentNo' => $post['regNo'],
        );
        /*
         * NOTE!!!
         * The magic value below is a hidden input that
         * helps in evaluating which type of query is to be executed.
         * */
        $magic_val = $post['magic_value'];

        if($magic_val == 0){
             $comment = $post['comment'];
             $value = $post['amount'];
             $student = $post['regNo'];
             DB::update("UPDATE charge INNER JOIN comments ON charge.students_studentNo = comments.students_studentNo
              SET comments.department = '$comment', charge.department_value = '$value'
              WHERE charge.students_studentNo = '$student' AND comments.students_studentNo = '$student' ");
         }
         elseif($magic_val == 1){
             $admin = DB::table('schools')
                 ->join('administrators','schools.administrator','=','administrators.admin_id')
                 ->select('administrators.email')->where('schools.department_name','=','Cafeteria')
                 ->pluck('email');
             //Send Mail
             Mail::send('mails.clear', ['student' => $std ], function($message) use($admin){
                 $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance');
             });
             $save = DB::table('charge')->insert($clear);
             $saveStatus = DB::table('clearstatus')->insert($status);
             $comSave = DB::table('comments')->insert($com);
         }
        return Redirect::back();
    }	
}
