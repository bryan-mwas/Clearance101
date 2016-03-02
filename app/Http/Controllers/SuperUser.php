<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Redirect;

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
        $users = DB::table('departments')->join('administrators','administrator','=','admin_id')
                                       ->select(DB::raw('CONCAT_WS(" ",fname,lname,sname) as name'),'departments.*')
//                                       ->where('departments.status','Inactive')
//                                       ->where('departments.department_name','FIT')
                                       ->get();
//        return $users;
        return view('admin.admin',compact('users'));
    }

    public function modify(Request $request){
        $post = $request->all();
        $id = $post['adminID'];

        DB::beginTransaction();
        $submit = DB::table('departments')->where('administrator',$id)->update(['status' => 'Active']);

        if($submit){
            DB::commit();
        }else{
            DB::rollBack();
        }
        return Redirect::back();
    }
}
