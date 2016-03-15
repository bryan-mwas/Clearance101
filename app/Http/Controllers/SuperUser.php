<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Redirect;
use Input;

class SuperUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Resume from this point.
        $users = DB::table('administrators')->get();
        return view('admin.viewStaff',compact('users'));
    }

    public function modify(Request $request){
        $post = $request->all();
        $id = $post['adminID'];

        DB::beginTransaction();
        $submit = DB::table('administrators')->where('payroll_number',$id)->update(['state' => 'Authorised']);

        if($submit){
            DB::commit();
        }else{
            DB::rollBack();
        }
        return Redirect::back();
    }
    public function displayAdd(){
      $response = file_get_contents('http://testserver.strathmore.edu:8082/dataservice/staff/getStaff/0');
      $staffInformation = json_decode($response, true);
      return view('admin/addstaff', compact('staffInformation'));
    }

    public function search(Request $request){
      $post = $request->all();
      $staff_id = $post['searchEmp'];
      $response = file_get_contents('http://testserver.strathmore.edu:8082/dataservice/staff/getStaff/'.$staff_id);
      $staffInformation = json_decode($response, true);
      return view('admin.addstaff', compact('staffInformation'));
      // return $staffInformation;
    }

    public function authorize(Request $request){
      $post = $request->all();

      DB::table('administrators')->insert(
          [
            'payroll_number' => $post['payrollNo'],
            'names' =>  $post['names'],
            'email' => $post['email'],
            'department' => $post['department'],
          ]
        );
        Session::flash('flash_msg','You have Authorized a new Clearance Administrator');
        // return Redirect::back();
    }
}
