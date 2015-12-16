<?php

namespace App\Functions;


class PDF
{

    public static function make($std)
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
            <td colspan="2">'.$std->sname.' '.$std->fname.' '.$std->lname.'</td>
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
               <p><br>Loan Taken <u><i>Kshs.</i></u> Amount Repaid <u><i>Kshs.</i></u> Balance <u><i>Ksh. </i></u><br>Lender <u><i></i></u> If there is an outstanding balance, show confirmation of registering with CRB **** Yes **** No ****<br>Name of Credit Reference Bureau Agency ****<br>Date <u><i></i></u> Signature **** (FINANCIAL AID OFFICER).</p>
 </div>
    </body>';


        return $end;


    }

    public static function create($std,$charge){

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
            <td colspan="2">'.$std->sname.' '.$std->fname.' '.$std->lname.'</td>
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
        <p></p><p></p><p></p>
        <footer align=right>DAA-03-01-09/12</footer>
    </body>';

        return $blah;
    }


}
