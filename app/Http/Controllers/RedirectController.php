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
  public function index(){
    Cas::getCurrentUser();
    $user = session('cas_user');
    $client = new \GuzzleHttp\Client();
    $response = $client->get('http://testserver.strathmore.edu:8082/dataservice/student/getStudent/'.user);
    dd($response->getBody());
  }
}
