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
    $name = 'FACULTY OF INFORMATION TECHNOLOGY';
    $title = 'FIT';
		$user = Auth::user()->regNo;
		$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();

		$students = DB::table('students')
                    ->where('students.faculty', '=', 'FIT')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);

        return view('staff/faculty', compact('name','title','students', 'userInformation'));
    }
  /* display students in SOA */
	public function schoolofAccountancy(){
        $name = 'SCHOOL OF ACCOUNTANCY';
        $title = 'SOA';
				$user = Auth::user()->regNo;
				$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SOA')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        return view('staff/faculty', compact('name','title','students', 'userInformation'));
	}
  /*DISPLAY students in sfae*/
	public function schoolOfFinanceAndAppliedEconomics(){
        $name = 'SCHOOL OF FINANCE AND APPLIED ECONOMICS';
        $title = 'SFAE';
				$user = Auth::user()->regNo;
				$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SFAE')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        return view('staff/faculty', compact('name','title','students', 'userInformation'));
	}
   /*display students in SHSS*/
	public function schoolOfHumanitiesAndSocialSciences(){
        $name = 'SCHOOL OF HUMANITIES AND SOCIAL SCIENCES';
        $title = 'SHSS';
				$user = Auth::user()->regNo;
				$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SHSS')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);

        return view('staff/faculty', compact('name','title','students', 'userInformation'));
	}

   /*display students in SMC*/
	public function schoolOfManagementAndCommerce(){
        $name = 'SCHOOL OF MANAGEMENT AND COMMERCE';
        $title = 'SMC';
				$user = Auth::user()->regNo;
				$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SMC')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        return view('staff/faculty', compact('name','title','students', 'userInformation'));
	}

    /* display student is SBS */
	public function strathmoreBusinessSchool(){
        $name = 'STRATHMORE BUSSINESS SCHOOL';
        $title = 'SBS';
				$user = Auth::user()->regNo;
				$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'SBS')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);

        return view('staff/faculty', compact('name','title','students', 'userInformation'));
	}

      /*display sls students */
	public function strathmoreLawSchool(){
        $name = 'STRATHMORE LAW SCHOOL';
        $title = 'FIT';
				$user = Auth::user()->regNo;
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
				$userInformation = DB::table('administrators')->select('administrators.*')->where('admin_id', '=', $user)->get();
		$students = DB::table('students')
                    ->where('students.faculty', '=', 'CTH')->where('state', '=', 'Activated')
                    ->whereNotIn('students.studentNo', function($q){
                         $q->select('students_studentNo')->from('charge');
                     })->paginate(15);
        return view('staff/faculty', compact('name','title','students', 'userInformation'));
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
             $save = DB::table('charge')->insert($clear);
             $saveStatus = DB::table('clearstatus')->insert($status);
             $comSave = DB::table('comments')->insert($com);

             //Send Mail
             $emails = ['mwathibrian7@gmail.com','brianphiri.9523@gmail.com', 'anamikoye52@gmail.com'];
             Mail::send('mails.clear', ['student' => $std ], function($message) use($emails)
             {
                 $message->to($emails)->from('strath.clearance@gmail.com', 'strath')->subject('Clearance');
             });

        return Redirect::back();
    }
}
