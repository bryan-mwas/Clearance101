<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Functions\PDF;
use\App\Models\Student;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use mPDF;

class AdminController extends Controller{
  public function index(){
       // $appliedStudents = DB::table('charge')->count();
       $appliedStudents = DB::table('students')->count();

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
                               ->with('stdSbsPend',$pendingStudentsSBS)
                               ->with('moneyOwedFac', $totalDep)
                               ->with('moneyOwedCaf', $totalCaf)
                               ->with('moneyOwedLib', $totalLib)
                               ->with('moneyOwedExc', $totalExc)
                               ->with('moneyOwedGam', $totalGam)
                               ->with('moneyOwedFna', $totalFna)
                               ->with('moneyOwedFin', $totalFin);
    }

  public static function report(){
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


        $html = PDF::report($appliedStudents, $clearedStudentsFac, $pendingStudentsFac, $clearedStudentsCaf, $pendingStudentsCaf, $clearedStudentsGam, $pendingStudentsGam, $clearedStudentsExa, $pendingStudentsExa, $clearedStudentsFna, $pendingStudentsFna, $clearedStudentsFin, $pendingStudentsFin, $clearedStudentsLib, $pendingStudentsLib, $totalStudentsCleared, $totalStudentsPending, $reqStudentFIT, $clearedStudentsFIT,$pendingStudentsFIT, $reqStudentSOA, $clearedStudentsSOA,$pendingStudentsSOA, $reqStudentSLS, $clearedStudentsSLS,$pendingStudentsSLS, $reqStudentSFAE, $clearedStudentsSFAE,$pendingStudentsSFAE, $reqStudentCHT, $clearedStudentsCHT,$pendingStudentsCHT, $reqStudentSHSS, $clearedStudentsSHSS, $pendingStudentsSHSS, $reqStudentSBS, $clearedStudentsSBS,$pendingStudentsSBS, $totalDep, $totalCaf, $totalLib, $totalExc, $totalGam, $totalFna, $totalFin);

        $mpdf=new mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    // Excel
  public function exReport(){

    Excel::create('StrathmoreClearanceReport', function($excel) {
        $excel->sheet('Students by Departments', function($sheet) {
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

            $data = [];
            array_push($data, array('', 'Department Name', 'Number of Cleared Students', 'Number of Pending Students'));
            array_push($data, array('','Departments', $clearedStudentsFac, $pendingStudentsFac));
            array_push($data, array('','Cafeteria',   $clearedStudentsCaf, $pendingStudentsCaf));
            array_push($data, array('','Library',     $clearedStudentsLib, $pendingStudentsLib));
            array_push($data, array('','extra_curricular', $clearedStudentsExa, $pendingStudentsExa));
            array_push($data, array('','games', $clearedStudentsGam, $pendingStudentsGam));
            array_push($data, array('','financial_aid', $clearedStudentsFna, $pendingStudentsFna));
            array_push($data, array('','finance', $clearedStudentsFin, $totalStudentsPending));

            $sheet->getStyle('B2')->applyFromArray(array('font' => array('name' => 'Calibri','size' => 14,'bold' => true)));
            $sheet->getStyle('C2')->applyFromArray(array('font' => array('name' => 'Calibri','size' => 14,'bold' => true)));
            $sheet->getStyle('D2')->applyFromArray(array('font' => array('name' => 'Calibri','size' => 14,'bold' => true)));

            $sheet->fromArray($data);
           });
           $excel->sheet('Students by Schools', function($sheet) {
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
               $clearedStudentsSFAE = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SFAE')->count();                $pendingStudentsSFAE = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SFAE')->count();
              //CHT
              $reqStudentCHT = DB::table('students')->where('state', '=', 'Activated')->where('faculty', '=', 'CHT')->count();
              $clearedStudentsCHT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'CHT')->count();
              $pendingStudentsCHT = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'CHT')->count();
              //SBS
              $reqStudentSBS = DB::table('students')->where('state', '=', 'Activated')->where('faculty', '=', 'SBS')->count();
              $clearedStudentsSBS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'CLeared')->where('students.faculty', '=', 'SBS')->count();
              $pendingStudentsSBS = DB::table('clearstatus')->join('students', 'clearstatus.students_studentNo', '=', 'students.studentNo')->where('clearstatus.status', '=', 'Pending')->where('students.faculty', '=', 'SBS')->count();

              $data1 = [];
              array_push($data1, array('', 'Faculty', 'Number of students Requesting Clearance','Number of Students Cleared', 'Number of students still Pending'));
              array_push($data1, array('','FIT', $reqStudentFIT, $clearedStudentsFIT, $pendingStudentsFIT));
              array_push($data1, array('','SLS', $reqStudentSLS, $clearedStudentsSLS, $pendingStudentsSLS));
              array_push($data1, array('','SOA', $reqStudentSOA, $clearedStudentsSOA, $pendingStudentsSOA));
              array_push($data1, array('','SHSS', $reqStudentSHSS, $clearedStudentsSHSS, $pendingStudentsSHSS));
              array_push($data1, array('','SFAE', $reqStudentSFAE, $clearedStudentsSFAE, $pendingStudentsSFAE));
              array_push($data1, array('','CHT', $reqStudentCHT, $clearedStudentsCHT, $pendingStudentsCHT));
              array_push($data1, array('','SBS', $reqStudentSBS, $clearedStudentsSBS, $pendingStudentsSBS));

              $sheet->getStyle('B2')->applyFromArray(array('font' => array('name' => 'Calibri','size' => 14,'bold' => true)));
              $sheet->getStyle('C2')->applyFromArray(array('font' => array('name' => 'Calibri','size' => 14,'bold' => true)));
              $sheet->getStyle('D2')->applyFromArray(array('font' => array('name' => 'Calibri','size' => 14,'bold' => true)));
              $sheet->getStyle('E2')->applyFromArray(array('font' => array('name' => 'Calibri','size' => 14,'bold' => true)));
              $sheet->fromArray($data1);
          });
          $excel->sheet('Finance', function($sheet) {
              $totalDep = DB::table('charge')->sum('department_value');
              if($totalDep == ''){
                $totalDep = 0;
              }
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


              $data2 = [];
              array_push($data2, array('', 'Department Name', 'Ammount Owed'));
              array_push($data2, array('','',''));
              array_push($data2, array('','Departments', $totalDep));
              array_push($data2, array('','Cafeteria',   $totalCaf));
              array_push($data2, array('','Library',     $totalLib));
              array_push($data2, array('','extra_curricular', $totalExc));
              array_push($data2, array('','games', $totalGam));
              array_push($data2, array('','financial_aid', $totalFna));
              array_push($data2, array('','finance', $totalFin));

              $sheet->getStyle('B2')->applyFromArray(array('font' => array('name' => 'Calibri','size' => 14,'bold' => true)));
              $sheet->getStyle('C2')->applyFromArray(array('font' => array('name' => 'Calibri','size' => 14,'bold' => true)));
              $sheet->fromArray($data2);

          });
      })->export('xls');
  }

}
