<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Functions\PDF;
use\App\Models\Student;
use App\Models\Charges;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use mPDF;
use Redirect;
use Illuminate\Support\Facades\DB;


class ViewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->regNo;

//      Attempts to get details of the student who is logged in.

        $std = student::where('studentNo', '=', $user)->first();
//        If the query has a result ...
        if($std != null){
        $charge=charges::where('students_studentNo','=',$user)->first();
        $comment=comment::where('students_studentNo','=',$user)->first();
            if ($std->state == 'Inactive') {
                return view('clearance.init');
            } else {
                return view('clearance.index')->with('std', $std)
                                              ->with('charge',$charge)
                                              ->with('comment',$comment);
                //return $charge;
            }
        }
        else{
//            For a null result in the above $std query. This block of code executes.
            $admin = DB::table('schools')->where('schools.administrator','=',$user)->pluck('department_name');

            if($admin == "FIT"){
                return redirect()->intended('/fit');
            }
            else if($admin == "SLS"){
                return redirect()->intended('/sls');
            }
            else if($admin == "SBS"){
                return redirect()->intended('/sbs');
            }
            else if($admin == "SFAE"){
                return redirect()->intended('/sfae');
            }
            else if($admin == "CTH"){
                return redirect()->intended('/cth');
            }
            else if($admin == "SOA"){
                return redirect()->intended('/soa');
            }
            else if($admin == "MTI"){
                return redirect()->intended('/mti');
            }
            else if($admin == "SHSS"){
                return redirect()->intended('/shss');
            }
            else if($admin == "SMC"){
                return redirect()->intended('/smc');
            }
            else if($admin == "Cafeteria"){
                return redirect()->intended('/cafeteria');
            }
            else if($admin == "Library"){
                return redirect()->intended('/library');
            }
            else if($admin == "Finance"){
                return redirect()->intended('/finance');
            }
            else if($admin == "Financial Aid"){
                return redirect()->intended('/financialAid');
            }
            else if($admin == "Games"){
                return redirect()->intended('/games');
            }
            else if($admin == "Extra-curricular"){
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
    public function show()
    {
        $user = Auth::user()->regNo;
        $std = student::where('studentNo','=',$user)->first();
        $charge=charges::where('students_studentNo','=',$user)->first();
        if($charge->total==0)
            $html = PDF::make($std);
        else
            $html = PDF::create($std,$charge);
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
        $admin = DB::table('schools')->where('schools.administrator','=',$user)->pluck('department_name');
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
