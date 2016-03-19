<?php

namespace App\Functions;


class PDF
{

    public static function make($std,$serial)
    {

        $end = '
    	   <body>
    	   <div style="text-align:center;">
    	   <img src="img/Strathmore_OK.png" align="middle" style="width:250px;height:80px; margin-left: auto; margin-right: auto">
    	   </div>
               <h2 align=center>STUDENT CLEARANCE CERTIFICATE</h2>

    <div>
      <table width="100%">
        <tbody>
            <tr>
            <th align=left>STUDENT NAME</th>
            <td colspan="2">'.$std->lname.'</td>
            </tr>
            <tr>
            <th align=left width="20%">REGISTRATION NUMBER</th>
            <td width="20%">'.$std->studentNo.'</td>
            <th align=left width="20%">TEL NUMBER</th>
            <td width="20%">'.$std->tel_no.'</td>
            </tr>
            <tr>
            <th align=left>POSTAL ADDRESS</th>
            <td>'.$std->postal_address.'</td>
            <th align=left width="20%">EMAIL ADDRESS</th>
            <td>'.$std->email.'</td>
            </tr>
            <tr>
            <th align=left>FACULTY/DEPARTMENT</th>
            <td>'.$std->faculty.'</td>
            <th align=left>COURSE</th>
            <td>'.$std->course.'</td>
            </tr>
        </tbody>
      </table>
            <hr>
            <h4>FACULTY/DEPARTMENT</h4>
            <div>
              <p>The above named student has handed over to me in good order all keys, equipment and University property for which he/she was responsible and which is under my Department </p>
            </div>
            <h4>CAFETERIA DEPARTMENT</h4>
            <div>
              <p>The above named student has accounted for all cutlery and crockery items on his/her charge </p>
            </div>
            <h4>LIBRARY</h4>
            <div>
              <p>The above named student has accounted for all library items on his/her charge </p>
            </div>
            <h4>GAMES DEPARTMENT</h4>
            <div>
              <p>The above named student has returned all games equipment and property borrowed under his/her name </p>
            </div>
            <h4>EXTRA-CURRICULAR ACTIVITIES</h4>
            <div>
              <p>The above named student has returned all games equipment and property borrowed under his/her name </p>
            </div>
            <h4>FINANCE</h4>
            <div>
               <p> The above named student has settled all balance owed to the University </p>
            </div>
            <h4>FINANCIAL AID OFFICE</h4>
            <div>
            <p> The above named student has settled all balance owed to the University </p>
 </div>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <p></p><p></p><p></p>
 <br><br><br><br><br><br><br><br><br>
 <hr>
 <footer style="position:absolute; width:100%;">
   <div>
     <table>
       <tr><td>Serial Number</td><td></td><td>Document Number</td></tr>
       <tr><td>'.$serial->serialNo.'</td><td>Strathmore University</td><td>DAA-03-01-09/12</td></tr>
     </table>
   </div>
    Serial Number: '.$serial->serialNo.' <br>
          DAA-03-01-09/12<br>
          Strathmore University '.Date('d-F-Y').'<br>
 </footer>
    </body>
    ';


        return $end;


    }

    public static function create($std,$charge,$serial){

        $blah = '
           <body>
           <div style="text-align:center;">
           <img src="img/Strathmore_OK.png" align="middle" style="width:250px;height:80px; margin-left: auto; margin-right: auto">
           </div>
               <h2 align=center>STUDENT CLEARANCE INVOICE</h2>

    <div>
      <table width="100%">
        <tbody>
            <tr>
            <th align=left>STUDENT NAME</th>
            <td colspan="2">'.$std->lname.'</td>
            </tr>
            <tr>
            <th align=left width="20%">REGISTRATION NUMBER</th>
            <td width="20%">'.$std->studentNo.'</td>
            <th align=left width="20%">TEL NUMBER</th>
            <td width="20%">'.$std->tel_no.'</td>
            </tr>
            <tr>
            <th align=left>POSTAL ADDRESS</th>
            <td>'.$std->postal_address.'</td>
            <th align=left width="20%">EMAIL ADDRESS</th>
            <td>'.$std->email.'</td>
            </tr>
            <tr>
            <th align=left>FACULTY/DEPARTMENT</th>
            <td>'.$std->faculty.'</td>
            <th align=left>COURSE</th>
            <td>'.$std->course.'</td>
            </tr>
            </tbody>
        </table>
      <div>

            <hr>
        <p></p>
        <table width="100%" style="border: 1px solid black">
        <tr><th align=left>DEPARTMENT</th><th align=left>VALUE</th></tr>
        <tr><td>FACULTY/DEPARTMENT</td><td>'.$charge->department_value.'</td></tr>
        <tr><td>CAFETERIA</td><td>'.$charge->cafeteria_value.'</td></tr>
        <tr><td>LIBRARY</td><td>'.$charge->library_value.'</td></tr>
        <tr><td>GAMES</td><td>'.$charge->games_value.'</td></tr>
        <tr><td>EXTRA-CURRICULAR ACTIVITIES</td><td>'.$charge->extra_curricular_value.'</td></tr>
        <tr><td>FINANCIAL AID</td><td>'.$charge->financial_aid_value.'</td></tr>
        <tr><td>FINANCE</td><td>'.$charge->finance_value.'</td></tr>
        <tr><th>TOTAL</th><td>'.$charge->total.'</td></tr>


        </table>
        <p></p><p></p><p></p>
        <p></p><p></p><p></p>
        <p></p><p></p><p></p>
        <p></p><p></p><p></p>
        <p></p><p></p><p></p>
        <p></p><p></p><p></p>
        <p></p><p></p><p></p>
        <p></p><p></p><p></p>
        <p></p>
        <hr>
        <footer style="position:absolute; width:100%;">
          <div>
            <table>
              <tr><td>Serial Number</td><td></td><td>Document Number</td></tr>
              <tr><td>'.$serial->serialNo.'</td><td>Strathmore University</td><td>DAA-03-01-09/12</td></tr>
            </table>
          </div>
          <div>
          </div>
        </footer>
    </body>';

        return $blah;
    }

    public static function report($appliedStudents, $clearedStudentsFac, $pendingStudentsFac, $clearedStudentsCaf, $pendingStudentsCaf, $clearedStudentsGam, $pendingStudentsGam, $clearedStudentsExa, $pendingStudentsExa, $clearedStudentsFna, $pendingStudentsFna, $clearedStudentsFin, $pendingStudentsFin, $clearedStudentsLib, $pendingStudentsLib, $totalStudentsCleared, $totalStudentsPending, $reqStudentFIT, $clearedStudentsFIT,$pendingStudentsFIT, $reqStudentSOA, $clearedStudentsSOA,$pendingStudentsSOA, $reqStudentSLS, $clearedStudentsSLS,$pendingStudentsSLS, $reqStudentSFAE, $clearedStudentsSFAE,$pendingStudentsSFAE, $reqStudentCHT, $clearedStudentsCHT,$pendingStudentsCHT, $reqStudentSHSS, $clearedStudentsSHSS, $pendingStudentsSHSS, $reqStudentSBS, $clearedStudentsSBS,$pendingStudentsSBS, $totalDep, $totalCaf, $totalLib, $totalExc, $totalGam, $totalFna, $totalFin){

         $end = '
    	   <body>
         <div style="text-align:center;">
        <img src="img/Strathmore_OK.png" align="middle" style="width:250px;height:80px; margin-left: auto; margin-right: auto">
        </div>
        <h2 style="text-align:center;">CLEARANCE REPORT</h2>
            <h4>Department Report</h4>
            <table class="table" style="border: 1px solid black; witdth:100%;" align="center">
                <thead>
                    <tr>
                    <th style="border-bottom:1px solid black ">Department Name</th>
                    <th style="border-bottom:1px solid black "># Requests from Students</th>
                    <th style="border-bottom:1px solid black "># Cleared Students</th>
                    <th style="border-bottom:1px solid black "># Pending Students</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Faculties</th>
                        <th>'.$appliedStudents.'</th>
                        <th>'.$clearedStudentsFac.'</th>
                        <th>'.$pendingStudentsFac.'</th>
                    </tr>
                    <tr>
                        <th>Cafeteria</th>
                        <th>'.$appliedStudents.'</th>
                        <th>'.$clearedStudentsCaf.'</th>
                        <th>'.$pendingStudentsCaf.'</th>
                    </tr>
                    <tr>
                        <th>Library</th>
                        <th>'.$appliedStudents.'</th>
                        <th>'.$clearedStudentsLib.'</th>
                        <th>'.$pendingStudentsLib.'</th>
                    </tr>
                    <tr>
                        <th>Games</th>
                        <th>'.$appliedStudents.'</th>
                        <th>'.$clearedStudentsGam.'</th>
                        <th>'.$pendingStudentsGam.'</th>
                    </tr>
                    <tr>
                        <th>Extra Curricular</th>
                        <th>'.$appliedStudents.'</th>
                        <th>'.$clearedStudentsExa.'</th>
                        <th>'.$pendingStudentsExa.'</th>
                    </tr>
                    <tr>
                        <th>Financial Aid</th>
                        <th>'.$appliedStudents.'</th>
                        <th>'.$clearedStudentsFna.'</th>
                        <th>'.$pendingStudentsFna.'</th>
                    </tr>
                    <tr>
                        <th>Finance</th>
                        <th>'.$appliedStudents.'</th>
                        <th>'.$clearedStudentsFin.'</th>
                        <th>'.$pendingStudentsFin.'</th>
                    </tr>
                    <tr style="border-top: 2px solid black;">
                    <th>Total Students</th>
                    <th>'.$appliedStudents.'</th>
                    <th>'.$totalStudentsCleared.'</th>
                    <th>'.$totalStudentsPending.'</th>
                    </tr>
                </tbody>
            </table>
            <br><br><hr><br><br>
            <center><h4>Faculty Report</h4></center>
            <table  class="table" style="border: 1px solid black; width:100%" align="center">
                <thead bgcolor="#FF9900">
                    <tr>
                        <th style="border-bottom:1px solid black ">Faculty Name</th>
                        <th style="border-bottom:1px solid black "># Requests from Students</th>
                        <th style="border-bottom:1px solid black "># Cleared Student</th>
                        <th style="border-bottom:1px solid black "># Pending Students</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th>FIT</th>
                    <th>'.$reqStudentFIT.'</th>
                    <th>'.$clearedStudentsFIT.'</th>
                    <th>'.$pendingStudentsFIT.'</th>
                    </tr>
                    <tr>
                    <th>SOA</th>
                    <th>'.$reqStudentSOA.'</th>
                    <th>'.$clearedStudentsSLS.'</th>
                    <th>'.$pendingStudentsSLS.'</th>
                    </tr>
                    <tr>
                    <th>SLS</th>
                    <th>'.$reqStudentSLS.'</th>
                    <th>'.$clearedStudentsSLS.'</th>
                    <th>'.$pendingStudentsSLS.'</th>
                    </tr>
                    <tr>
                    <th>SBS</th>
                    <th>'.$reqStudentSBS.'</th>
                    <th>'.$clearedStudentsSBS.'</th>
                    <th>'.$pendingStudentsSBS.'</th>
                    </tr>
                    <tr>
                    <th>SFAE</th>
                    <th>'.$reqStudentSFAE.'</th>
                    <th>'.$clearedStudentsSFAE.'</th>
                    <th>'.$pendingStudentsSFAE.'</th>
                    </tr>
                    <tr>
                    <th>CHT</th>
                    <th>'.$reqStudentCHT.'</th>
                    <th>'.$clearedStudentsCHT.'</th>
                    <th>'.$pendingStudentsCHT.'</th>
                    </tr>
                    <tr>
                    <th>SHSS</th>
                    <th>'.$reqStudentSHSS.'</th>
                    <th>'.$clearedStudentsSHSS.'</th>
                    <th>'.$pendingStudentsSHSS.'</th>
                    </tr>
                </tbody>
            </table>
            <br><hr><br><br>
            <table class=" table" style="border: 1px solid black; width:75%;" align="center">
                <thead bgcolor="#FF9900">
                    <tr>
                        <th style="border-bottom:1px solid black ">Department Name</th>
                        <th style="border-bottom:1px solid black "># Total Amount Owed</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Faculties</th>
                        <th>'.$totalDep.'</th>
                    </tr>
                    <tr>
                        <th>Cafeteria</th>
                        <th>'.$totalCaf.'</th>
                    </tr>
                    <tr>
                        <th>Library</th>
                        <th>'.$totalLib.'</th>
                    </tr>
                    <tr>
                        <th>Games</th>
                        <th>'.$totalGam.'</th>
                    </tr>
                    <tr>
                        <th>Extra Curricular Activities</th>
                        <th>'.$totalExc.'</th>
                    </tr>
                    <tr>
                        <th>Financial Aid</th>
                        <th>'.$totalFna.'</th>
                    </tr>
                    <tr>
                        <th>Finance</th>
                        <th>'.$totalFin.'</th>
                    </tr>
                </tbody>
            </table>
    	   </body>';
        return $end;

    }
}
