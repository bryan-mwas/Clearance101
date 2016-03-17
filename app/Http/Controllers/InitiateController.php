<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use DB;
use Cas;

class InitiateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      Cas::getCurrentUser();
      $user = session('cas_user');
      $response = file_get_contents('http://testserver.strathmore.edu:8082/dataservice/student/getStudent/'.$user);
      $student = json_decode($response, true);

      DB::table('students')->insert(
          [
            'studentNo' => $student['studentNo'],
            'lname' => $student['studentNames'],
            'sname' => $student['surname'],
            'fname' => $student['otherNames'],
            'email' => $student['email'],
            'postal_address' => 'null',
            'tel_no' => $student['mobileNo'],
            'faculty' => $student['faculties'],
            'course' => $student['courses'],
          ]
        );

        Session::flash('flash_msg','You have initiated the clearance process');
        return redirect('/');

    }
}
