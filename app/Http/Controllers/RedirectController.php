<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Functions\PDF;
use\App\Models\Student;
use\App\Models\Serial;
use App\Models\Charges;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Administrators;
use Cas;

class RedirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function student($id){
    return view('test')->with('std', $std);
  }

  public function index(){
    Cas::getCurrentUser();
    $user = session('cas_user');
    $client = new \GuzzleHttp\Client();

    // $response = $client->get('http://testserver.strathmore.edu:8082/dataservice/student/getStudent/'.$user);
    $responseStudent = file_get_contents('http://testserver.strathmore.edu:8082/dataservice/student/getStudent/'.$user);

    $responseStaff = file_get_contents('http://testserver.strathmore.edu:8082/dataservice/staff/getStaff/'.$user);

    // check to see if the logged in user is a student
    if ($responseStaff == '' && $responseStudent != ''){
      $student = json_decode($responseStudent, true);

      // check to see if student has already initiated the clearance process
      // if student has not requested to be cleared, he/she is taken to the clear request page
      $std = student::where('studentNo', '=', $user)->first();

      // for testing, delete after test
      // if($student['studentNo'] == '78699'){
      //   return redirect()->intended('/cafeteria');
      // }


      //If the query has a result ...
      if($std === null){
          return view('clearance.init')->with('student', $student);
      }else{
        $charge=charges::where('students_studentNo','=',  $user)->first();
        $comment=comment::where('students_studentNo','=', $user)->first();

        return view('clearance.index')->with('std', $std)
                                      ->with('charge',$charge)
                                      ->with('comment',$comment);
      }

    }
    // If logged in user in a member of staff...
    elseif($responseStaff != '' && $responseStudent == '') {
      $staffMember = json_decode($responseStaff, true);
      $school_staff_belongs_to = $staffMember['departmentShortName'];

      // redirect the staff member to thier page depending on the school they admin..
      if($school_staff_belongs_to == 'FIT'){
          return redirect()->intended('/fit');
      }

      else if($school_staff_belongs_to == "SLS"){
          return redirect()->intended('/sls');
      }
      else if($school_staff_belongs_to == "SBS"){
          return redirect()->intended('/sbs');
      }
      else if($school_staff_belongs_to == "SFAE"){
          return redirect()->intended('/sfae');
      }
      else if($school_staff_belongs_to == "CTH"){
          return redirect()->intended('/cth');
      }
      else if($school_staff_belongs_to == "SOA"){
          return redirect()->intended('/soa');
      }
      else if($school_staff_belongs_to == "MTI"){
          return redirect()->intended('/mti');
      }
      else if($school_staff_belongs_to == "SHSS"){
          return redirect()->intended('/shss');
      }
      else if($school_staff_belongs_to == "SMC"){
          return redirect()->intended('/smc');
      }else{
        // if the admin does not admin a school. Query by department name
        if($school_staff_belongs_to == "Cafeteria"){
            return redirect()->intended('/cafeteria');
        }
        else if($school_staff_belongs_to == "Library"){
            return redirect()->intended('/library');
        }
        else if($school_staff_belongs_to == "Finance"){
            return redirect()->intended('/finance');
        }
        else if($school_staff_belongs_to == "Financial Aid"){
            return redirect()->intended('/financialAid');
        }
        else if($school_staff_belongs_to == "Games"){
            return redirect()->intended('/games');
        }
        else if($school_staff_belongs_to == "Extra-curricular"){
            return redirect()->intended('/extraCurricularActivities');
        }
      }

    }


  }


  public function destroy(){
   Cas::logout();
   return redirect()->intended('/');
 }
}
