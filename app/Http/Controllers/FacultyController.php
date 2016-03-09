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


class FacultyController extends Controller{
	public function facultyInformationTechnology(){
    $name     = 'FACULTY OF INFORMATION TECHNOLOGY';
    $title    = 'FIT';
		$message  = "Please Attend to the following students Requesting to be cleared";
		$user     = Auth::user()->regNo;
		$userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');



		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'FIT')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);

    	return view('staff/faculty', compact('name','title','students', 'userInformation','message'));
    }
  /* display students in SOA */
	public function schoolofAccountancy(){
    $name = 'SCHOOL OF ACCOUNTANCY';
    $title = 'SOA';
		$user = Auth::user()->regNo;
		$userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');
		$message = "Please Attend to the following students Requesting to be cleared";
		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SOA')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
    return view('staff/faculty', compact('name','title','students', 'userInformation', 'message'));
	}
  /*DISPLAY students in sfae*/
	public function schoolOfFinanceAndAppliedEconomics(){
    $name = 'SCHOOL OF FINANCE AND APPLIED ECONOMICS';
    $title = 'SFAE';
		$user = Auth::user()->regNo;
		$userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

		$message = "Please Attend to the following students Requesting to be cleared";
		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SFAE')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
    return view('staff/faculty', compact('name','title','students', 'userInformation','message'));
	}
   /*display students in SHSS*/
	public function schoolOfHumanitiesAndSocialSciences(){
    $name = 'SCHOOL OF HUMANITIES AND SOCIAL SCIENCES';
    $title = 'SHSS';
		$user = Auth::user()->regNo;
		$userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

		$message = "Please Attend to the following students Requesting to be cleared";

		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SHSS')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);

    return view('staff/faculty', compact('name','title','students', 'userInformation','message'));
	}

   /*display students in SMC*/
	public function schoolOfManagementAndCommerce(){
        $name = 'SCHOOL OF MANAGEMENT AND COMMERCE';
        $title = 'SMC';
				$user = Auth::user()->regNo;
				$userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

				$message = "Please Attend to the following students Requesting to be cleared";

				$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SMC')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        return view('staff/faculty', compact('name','title','students', 'userInformation','message'));
	}

    /* display student is SBS */
	public function strathmoreBusinessSchool(){

    $name = 'STRATHMORE BUSSINESS SCHOOL';
    $title = 'SBS';
		$user = Auth::user()->regNo;
		$userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

		$message = "Please Attend to the following students Requesting to be cleared";

		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                ->where('students.faculty', '=', 'SBS')->where('state', '=', 'Activated')
                ->whereNotIn('students.studentNo', function($q){
                     $q->select('students_studentNo')->from('charge');
                 })->paginate(15);

    return view('staff/faculty', compact('name','title','students', 'userInformation','message'));
	}

      /*display sls students */
	public function strathmoreLawSchool(){
    $name = 'STRATHMORE LAW SCHOOL';
    $title = 'SLS';
		$user = Auth::user()->regNo;
		$userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

		$message = "Please Attend to the following students Requesting to be cleared";
		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SLS')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
    return view('staff/faculty', compact('name','title','students', 'userInformation'));
	}

      /*display students is CTH*/
	public function centreForTourismAndHospitality(){
      $name = 'CENTER FOR TOURISIM AND HOSPITALITY';
      $title = 'CTH';
			$user = Auth::user()->regNo;
			$userMail = DB::table('administrators')->where('admin_id', '=', $user)->pluck('email');

			$message = "Please Attend to the following students Requesting to be cleared";

			$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
			$students = DB::table('students')
                  ->where('students.faculty', '=', 'CTH')->where('state', '=', 'Activated')
                  ->whereNotIn('students.studentNo', function($q){
                        $q->select('students_studentNo')->from('charge');
                    })->paginate(15);
    return view('staff/faculty', compact('name','title','students', 'userInformation','message'));
	}

	/*clear off student*/
	 public function clear(Request $request){
        $post = $request->all();
        $std = $post['regNo'];
				$value = $post['amount'];
				$comment = $post['comment'];
				$clearedAt = $post['signedAt'];
	  	$clearedBy = $post['signedBy'];

				$comment = preg_replace('/[^A-Za-z0-9 _]/','', $comment);
        $value = preg_replace('/[^0-9]/','', $value);

        $clear = array(
            'students_studentNo' => $post['regNo'],
            'department_value'   => $value,
            'queueFlag'          => '1',
            );

      	$save = DB::table('charge')->insert($clear);

				DB::beginTransaction();
					$submit = DB::update("UPDATE cleared_by
						INNER JOIN comments ON cleared_by.students_studentNo = comments.students_studentNo
						INNER JOIN cleared_at ON cleared_by.students_studentNo = cleared_at.students_studentNo
						SET
						comments.department = '$comment',
						cleared_at.department_cleared_at = '$clearedAt',
						cleared_by.department_cleared_by = '$clearedBy'

						WHERE comments.students_studentNo = '$std'
						AND cleared_at.students_studentNo = '$std'
						AND cleared_by.students_studentNo='$std' ");

						if($submit){
						  DB::commit();
						}else{
						  DB::rollBack();
						}

             //Send Mail
             $emails = ['mwathibrian7@gmail.com','brianphiri.9523@gmail.com', 'anamikoye52@gmail.com'];
             Mail::send('mails.clear', ['student' => $std ], function($message) use($emails)
             {
                 $message->to($emails)->from('strath.clearance@gmail.com', 'strath')->subject('Clearance');
             });

        return Redirect::back();
    }
}
