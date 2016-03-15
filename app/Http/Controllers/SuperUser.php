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
    // student functions

    public function studentSearch(Request $request){
      $post = $request->all();
      $search = $post['search'];
      if($search == ''){
        $search = 0;
      }
      $students = DB::table('document_serialNo')->join('students', 'document_serialNo.students_studentNo', '=', 'students.studentNo')->where('document_serialNo.serialNo','=', $search)->get();

      return view('admin.viewstudent', compact('students'));
    }
    public function studentView(){
      $students = DB::table('document_serialNo')->join('students', 'document_serialNo.students_studentNo', '=', 'students.studentNo')->paginate(15);

      return view('admin.viewstudent', compact('students'));
    }

    // reports

    public function clearanceReport(){
         // $appliedStudents = DB::table('charge')->count();
         $appliedStudents = DB::table('students')->count();

         $clearedStudentsFac = DB::table('cleared_by')->where('cleared_by.department_cleared_by', '!=', 'N/A')->count();
         $pendingStudentsFac = DB::table('cleared_by')->where('cleared_by.department_cleared_by', '=', 'N/A')->count();
         //cafeteria
         $clearedStudentsCaf = DB::table('cleared_by')->where('cleared_by.cafeteria_cleared_by', '!=', 'N/A')->count();
         $pendingStudentsCaf = DB::table('cleared_by')->where('cleared_by.cafeteria_cleared_by', '=', 'N/A')->count();
         //library
         $clearedStudentsLib = DB::table('cleared_by')->where('cleared_by.library_cleared_by', '!=', 'N/A')->count();
         $pendingStudentsLib = DB::table('cleared_by')->where('cleared_by.library_cleared_by', '=', 'N/A')->count();
         //Ex-Act
         $clearedStudentsExa = DB::table('cleared_by')->where('cleared_by.extra_curricular_cleared_by', '!=', 'N/A')->count();
         $pendingStudentsExa = DB::table('cleared_by')->where('cleared_by.extra_curricular_cleared_by', '=', 'N/A')->count();
         //Games
         $clearedStudentsGam = DB::table('cleared_by')->where('cleared_by.games_cleared_by', '!=', 'N/A')->count();
         $pendingStudentsGam = DB::table('cleared_by')->where('cleared_by.games_cleared_by', '=', 'N/A')->count();
         //F-Aid
         $clearedStudentsFna = DB::table('cleared_by')->where('cleared_by.financial_aid_cleared_by', '!=', 'N/A')->count();
         $pendingStudentsFna = DB::table('cleared_by')->where('cleared_by.financial_aid_cleared_by', '=', 'N/A')->count();
         //Fin
         $clearedStudentsFin = DB::table('cleared_by')->where('cleared_by.finance_cleared_by', '!=', 'N/A')->count();
         $pendingStudentsFin = DB::table('cleared_by')->where('cleared_by.finance_cleared_by', '=', 'N/A')->count();
         //total Students
         $totalStudentsCleared = DB::table('clearstatus')->where('status', '=', 'Cleared')->count();
         $totalStudentsPending = DB::table('clearstatus')->where('status', '=', 'Pending')->count();

         //faculty
         //FIT
         $reqStudentFIT = DB::table('students')->where('faculty', '=', 'FIT')->count();
         $clearedStudentsFIT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'FIT')->count();
         $pendingStudentsFIT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'FIT')->count();
         //SLS
         $reqStudentSLS = DB::table('students')->where('faculty', '=', 'SLS')->count();
         $clearedStudentsSLS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SLS')->count();
         $pendingStudentsSLS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SLS')->count();
         //SOA
         $reqStudentSOA = DB::table('students')->where('faculty', '=', 'SOA')->count();
         $clearedStudentsSOA = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SOA')->count();
         $pendingStudentsSOA = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SOA')->count();
         //SHSS
         $reqStudentSHSS = DB::table('students')->where('faculty', '=', 'SHSS')->count();
         $clearedStudentsSHSS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SHSS')->count();
         $pendingStudentsSHSS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SHSS')->count();
         //SFAE
         $reqStudentSFAE = DB::table('students')->where('faculty', '=', 'SFAE')->count();
         $clearedStudentsSFAE = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SFAE')->count();
         $pendingStudentsSFAE = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SFAE')->count();
         //SOA
         $reqStudentCHT = DB::table('students')->where('faculty', '=', 'CHT')->count();
         $clearedStudentsCHT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'CHT')->count();
         $pendingStudentsCHT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'CHT')->count();
         //SOA
         $reqStudentSBS = DB::table('students')->where('faculty', '=', 'SBS')->count();
         $clearedStudentsSBS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SBS')->count();
         $pendingStudentsSBS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SBS')->count();

         //financial report
         //facuty
         $totalDep = DB::table('charge')->sum('department_value');
         //cafeteria
         $totalCaf = DB::table('charge')->sum('cafeteria_value');
         // library
         $totalLib = DB::table('charge')->sum('library_value');
         //Extra Cal
         $totalExc = DB::table('charge')->sum('extra_curricular_value');
         //games
         $totalGam = DB::table('charge')->sum('games_value');
         //financial aid
         $totalFna = DB::table('charge')->sum('financial_aid_value');
         //finance
         $totalFin = DB::table('charge')->sum('finance_value');

         #return $clearedStudentsFac;
          return view('admin/clearancereport')->with('std', $appliedStudents)
                                 ->with('stdFacClear', $clearedStudentsFac)
                                 ->with('stdFacPend', $pendingStudentsFac)
                                 ->with('stdCafClear', $clearedStudentsCaf)
                                 ->with('stdCafPend', $pendingStudentsCaf)
                                 ->with('stdGamClear', $clearedStudentsGam)
                                 ->with('stdGamPend', $pendingStudentsGam)
                                 ->with('stdExaClear', $clearedStudentsExa)
                                 ->with('stdExaPend', $pendingStudentsExa)
                                 ->with('stdFnaClear', $clearedStudentsFna)
                                 ->with('stdFnaPend', $pendingStudentsFna)
                                 ->with('stdFinClear', $clearedStudentsFin)
                                 ->with('stdFinPend', $pendingStudentsFin)
                                 ->with('stdLibClear', $clearedStudentsLib)
                                 ->with('stdLibPend', $pendingStudentsLib)
                                 ->with('stdTotalClear', $totalStudentsCleared)
                                 ->with('stdTotalPend', $totalStudentsPending)
                                 ->with('stdFit', $reqStudentFIT)
                                 ->with('stdFitClear', $clearedStudentsFIT)
                                 ->with('stdFitPend',$pendingStudentsFIT)
                                 ->with('stdSoa', $reqStudentSOA)
                                 ->with('stdSoaClear', $clearedStudentsSOA)
                                 ->with('stdSoaPend',$pendingStudentsSOA)
                                 ->with('stdSls', $reqStudentSLS)
                                 ->with('stdSlsClear', $clearedStudentsSLS)
                                 ->with('stdSlsPend',$pendingStudentsSLS)
                                 ->with('stdSfae', $reqStudentFIT)
                                 ->with('stdSfaeClear', $clearedStudentsSFAE)
                                 ->with('stdSfaePend',$pendingStudentsSFAE)
                                 ->with('stdCht', $reqStudentCHT)
                                 ->with('stdChtClear', $clearedStudentsCHT)
                                 ->with('stdChtPend',$pendingStudentsCHT)
                                 ->with('stdShss', $reqStudentSHSS)
                                 ->with('stdShssClear', $clearedStudentsSHSS)
                                 ->with('stdShssPend',$pendingStudentsSHSS)
                                 ->with('stdSbs', $reqStudentSBS)
                                 ->with('stdSbsClear', $clearedStudentsSBS)
                                 ->with('stdSbsPend',$pendingStudentsSBS);
      }

      public function financialReport(){
        //financial report
        //facuty
        $totalDep = DB::table('charge')->sum('department_value');
        //cafeteria
        $totalCaf = DB::table('charge')->sum('cafeteria_value');
        // library
        $totalLib = DB::table('charge')->sum('library_value');
        //Extra Cal
        $totalExc = DB::table('charge')->sum('extra_curricular_value');
        //games
        $totalGam = DB::table('charge')->sum('games_value');
        //financial aid
        $totalFna = DB::table('charge')->sum('financial_aid_value');
        //finance
        $totalFin = DB::table('charge')->sum('finance_value');

        return view('admin/financialreport')
                               ->with('moneyOwedFac', $totalDep)
                               ->with('moneyOwedCaf', $totalCaf)
                               ->with('moneyOwedLib', $totalLib)
                               ->with('moneyOwedExc', $totalExc)
                               ->with('moneyOwedGam', $totalGam)
                               ->with('moneyOwedFna', $totalFna)
                               ->with('moneyOwedFin', $totalFin);
      }

      public function exportPdf(){
        app('App\Http\Controllers\AdminController')->report();
      }
      public function exportExc(){
        app('App\Http\Controllers\AdminController')->exReport();
      }
}
