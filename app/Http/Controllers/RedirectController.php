<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Functions\PDF;
use\App\Models\Student;
use\App\Models\Serial;
use App\Models\Charges;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use mPDF;
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
    // student($user);
    // $response = $client->get('http://testserver.strathmore.edu:8082/dataservice/student/getStudent/'.$user);
    $response = file_get_contents('http://testserver.strathmore.edu:8082/dataservice/student/getStudent/'.$user);
    // $student = json_encode($response);
    $student = json_decode($response, true);
    // return view('test')->with('std', $student);

    $std = student::where('studentNo', '=', $user)->first();
//        If the query has a result ...
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


  public function destroy(){
   Cas::logout();
 }
}
