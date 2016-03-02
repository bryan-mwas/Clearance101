<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use DB;
class MailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user()->regNo;
        $res = DB::table('students')->select('faculty')->where('studentNo','=',$user)->pluck('faculty');
        
        //Query below gets the email of the specific administrator
        $admin = DB::table('departments')
                        ->join('administrators','departments.administrator','=','administrators.admin_id')
                        ->select('administrators.email')->where('departments.department_name','=',$res)
                        ->pluck('email');
        Mail::send('mails.welcome', ['name' => 'Angela Namikoye, Brian Phiri'], function($message) use($admin)
        {
            $message->to($admin)->from('strath.clearance@gmail.com', 'Strathmore University')->subject('Clearance Request');
        });

        student::where('studentNo','=',$user)->update(['state' => 'Activated']);
        Session::flash('flash_msg','You have initiated the clearance process');
        return redirect('/student');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
