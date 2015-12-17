<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class AdminController extends Controller{
    public function index(){
       // $appliedStudents = DB::table('charge')->count();
       $appliedStudents = DB::table('clearstatus')->count();
       
       $clearedStudentsFac = DB::table('charge')->where('charge.department_value', '=', '0')->count();
       $pendingStudentsFac = DB::table('charge')->where('charge.department_value', '>', '0')->count();
       //cafeteria
       $clearedStudentsCaf = DB::table('charge')->where('charge.cafeteria_value', '=', '0')->count();
       $pendingStudentsCaf = DB::table('charge')->where('charge.cafeteria_value', '>', '0')->count();
       //library
       $clearedStudentsLib = DB::table('charge')->where('charge.library_value', '=', '0')->count();
       $pendingStudentsLib = DB::table('charge')->where('charge.library_value', '>', '0')->count();
       //Ex-Act
       $clearedStudentsExa = DB::table('charge')->where('charge.extra_curricular_value', '=', '0')->count();
       $pendingStudentsExa = DB::table('charge')->where('charge.extra_curricular_value', '>', '0')->count();
       //Games
       $clearedStudentsGam = DB::table('charge')->where('charge.games_value', '=', '0')->count();
       $pendingStudentsGam = DB::table('charge')->where('charge.games_value', '>', '0')->count();
       //F-Aid
       $clearedStudentsFna = DB::table('charge')->where('charge.financial_aid_value', '=', '0')->count();
       $pendingStudentsFna = DB::table('charge')->where('charge.financial_aid_value', '>', '0')->count();
       //Fin
       $clearedStudentsFin = DB::table('charge')->where('charge.finance_value', '=', '0')->count();
       $pendingStudentsFin = DB::table('charge')->where('charge.finance_value', '>', '0')->count();
       //total Students
       $totalStudentsCleared = DB::table('clearstatus')->where('status', '=', 'Cleared')->count();
       $totalStudentsPending = DB::table('clearstatus')->where('status', '=', 'Pending')->count();
       
       //faculty
       //FIT 
       $reqStudentFIT = DB::table('students')->where('state', '=', 'Activated')->where('faculty', '=', 'FIT')->count();
       $clearedStudentsFIT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'FIT')->count();
       $pendingStudentsFIT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'FIT')->count();
       //SLS 
       $reqStudentSLS = DB::table('students')->where('state', '=', 'Activated')->where('faculty', '=', 'SLS')->count();
       $clearedStudentsSLS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SLS')->count();
       $pendingStudentsSLS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SLS')->count();
       //SOA 
       $reqStudentSOA = DB::table('students')->where('state', '=', 'Activated')->where('faculty', '=', 'SOA')->count();
       $clearedStudentsSOA = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SOA')->count();
       $pendingStudentsSOA = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SOA')->count();
       //SHSS 
       $reqStudentSHSS = DB::table('students')->where('state', '=', 'Activated')->where('faculty', '=', 'SHSS')->count();
       $clearedStudentsSHSS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SHSS')->count();
       $pendingStudentsSHSS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SHSS')->count();
       //SFAE 
       $reqStudentSFAE = DB::table('students')->where('state', '=', 'Activated')->where('faculty', '=', 'SFAE')->count();
       $clearedStudentsSFAE = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SFAE')->count();
       $pendingStudentsSFAE = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SFAE')->count();
       //SOA 
       $reqStudentCHT = DB::table('students')->where('state', '=', 'Activated')->where('faculty', '=', 'CHT')->count();
       $clearedStudentsCHT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'CHT')->count();
       $pendingStudentsCHT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'CHT')->count();
       //SOA 
       $reqStudentSBS = DB::table('students')->where('state', '=', 'Activated')->where('faculty', '=', 'SBS')->count();
       $clearedStudentsSBS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SBS')->count();
       $pendingStudentsSBS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SBS')->count();
      # return $clearedStudentsFac;
        return view('admin/vc')->with('std', $appliedStudents)
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
}