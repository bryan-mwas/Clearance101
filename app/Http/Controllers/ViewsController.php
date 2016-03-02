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


class ViewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//      I anticipate some rough time in this bit. Cause its Oracle database for students and MySQL for the HR Department!

        $user = Auth::user()->regNo;

//      Attempts to get details of the student who is logged in.

        $std = student::where('studentNo', '=', $user)->first();
//        If the query has a result ...
        if($std != null){
        $charge=charges::where('students_studentNo','=',$user)->first();
        $comment=comment::where('students_studentNo','=',$user)->first();
            if ($std->state == 'Inactive') {
                $student = DB::connection('oracle')->table('CLEARANCE.STUDENT')->where('student_no', '=', '$user');
                return view('clearance.init')->with('student', $student);
            } else {
                return view('clearance.index')->with('std', $std)
                                              ->with('charge',$charge)
                                              ->with('comment',$comment);
                //return $charge;
            }
        }
        else{
//            For a null result in the above $std query. This block of code executes.
//            This query will be vital for the delegation purposes.
//            $admin = DB::table('departments')->where('departments.administrator','=',$user)->first();
            $admin = Administrators::where('administrator',$user)->first();
            $dept = $admin->department_name;
            $status =$admin->status;
//            return $delegation;

            if($dept == 'FIT' && $status == 'Active'){
                return redirect()->intended('/fit');
            }
//            else{
//                return 'Hey there! You are an admin but you need to be delegated some authority from above.';
//            }
            else if($dept == "SLS"){
                return redirect()->intended('/sls');
            }
            else if($dept == "SBS"){
                return redirect()->intended('/sbs');
            }
            else if($dept == "SFAE"){
                return redirect()->intended('/sfae');
            }
            else if($dept == "CTH"){
                return redirect()->intended('/cth');
            }
            else if($dept == "SOA"){
                return redirect()->intended('/soa');
            }
            else if($dept == "MTI"){
                return redirect()->intended('/mti');
            }
            else if($dept == "SHSS"){
                return redirect()->intended('/shss');
            }
            else if($dept == "SMC"){
                return redirect()->intended('/smc');
            }
            else if($dept == "Cafeteria"){
                return redirect()->intended('/cafeteria');
            }
            else if($dept == "Library"){
                return redirect()->intended('/library');
            }
            else if($dept == "Finance"){
                return redirect()->intended('/finance');
            }
            else if($dept == "Financial Aid"){
                return redirect()->intended('/financialAid');
            }
            else if($dept == "Games"){
                return redirect()->intended('/games');
            }
            else if($dept == "Extra-curricular"){
                return redirect()->intended('/extraCurricularActivities');
            }
            else{
                /*
                 * For test purposes! Nerds ONLY!! ;-)
                 * */
                return redirect()->intended('/vc');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user()->regNo;
        $std = student::where('studentNo','=',$user)->first();
        $charge=charges::where('students_studentNo','=',$user)->first();
        $serial = Serial::where('students_studentNo','=',$user)->first();
        if($charge->total==0)
            $html = PDF::make($std, $serial);
        else
            $html = PDF::create($std,$charge, $serial);
        $mpdf=new mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();


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
    /**
     * @return This returns the school_id that the administrator is in charge of.
     */
    public function findSpec(){
        $user = Auth::user()->regNo;
        $admin = DB::table('departments')->where('departments.administrator','=',$user)->pluck('department_name');
        return $admin;
    }
    /**
     * This is for the management
     */
    public function leadership(){
        $user = Auth::user()->regNo;
        $leader = DB::table('management')->where('id','=',$user)->pluck('role');
        return $leader;
    }
}
