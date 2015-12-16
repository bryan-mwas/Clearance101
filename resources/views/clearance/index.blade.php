@extends('master')

@section('title','Clearance App')

@section('content')
    <div class="container-fluid" style="font-family: 'Trebuchet MS'">
        <div class="page-header" style="border-bottom:hidden">
            <img src="../img/Strathmore_OK.png"  alt="Strathmore University" style="display: block; margin-left: auto; margin-right: auto "/>
            <h1><center>STUDENT CLEARANCE FORM </center></h1><br>
        </div>

        <div id="student_details" style="font-size: 115%">
            <table class="table table-bordered" width="50%">
                <tbody>
                <tr>
                    <th>STUDENT NAME</th>
                    <td colspan="3">{{$std->sname}} {{$std->fname}} {{$std->lname}}</td>
                </tr>
                <tr>
                    <th width="20%">REGISTRATION NUMBER</th>
                    <td width="20%">{{$std->studentNo}}</td>
                    <th width="20%">TELEPHONE NUMBER</th>
                    <td width="20%">{{$std->tel_no}}</td>
                </tr>
                <tr>
                    <th>POSTAL ADDRESS</th>
                    <td>{{$std->postal_address}}</td>
                    <th witdh="20%">EMAIL ADDRESS</th>
                    <td>{{$std->email}}</td>
                </tr>
                <tr>
                    <th>FACULTY/DEPARTMENT</th>
                    <td>{{$std->faculty}}</td>
                    <th>COURSE</th>
                    <td>{{$std->course}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div id="Accordion1">
            <h3><a href="#">Faculty/Department</a></h3>
            <div>
                <p><strong>FACULTY/DEPARTMENT: </strong>The above named student has handed over to me in good order all keys, equipment and University property for which he/she was responsible and which is under my department
                    @if($charge->department_value !== 0)
                        with the exception of <u>{{$comment->department}}</u> worth <u><i>Ksh. {{$charge->department_value}}</i></u></p>
                @endif
            </div>
            <h3><a href="#">Cafeteria Department</a></h3>
            <div>
                <p><strong>CAFETERIA DEPARTMENT: </strong>The above named student has accounted for all cutlery and crockery item on his/her charge
                    @if($charge->cafeteria_value!==0)
                        , with the exception of charges worth <u><i>Ksh. {{$charge->cafeteria_value}}</i></u> because he/she <u>{{$comment->cafeteria}}</u></p>
                @endif
            </div>
            <h3><a href="#">Library</a></h3>
            <div>
                <p><strong>LIBRARY: </strong>The above named student has accounted for all the library items on his/her charge
                    @if($charge->library_value!==0)
                        with the exception of <u><i>{{$comment->library}}</i></u> valued at <u><i>Ksh. {{$charge -> library_value}}</i></u></p>
                @endif
            </div>
            <h3><a href="#">Games Department</a></h3>
            <div>
                @if($charge->games_value!==0)
                    <p><strong>GAMES DEPARTMENT: </strong>The above named student has not returned all games equipment and property borrowed under his name</p>
                    <p align=center>STATUS: NOT CLEARED</p>
                @else
                    <p><strong>GAMES DEPARTMENT: </strong>The above named student has returned all games equipment and property borrowed under his name</p>
                @endif
            </div>
            <h3><a href="#">Extra-curricular activities</a></h3>
            <div>
                @if($charge->extra_curricular_value!==0)
                    <p><strong>EXTRA-CURRICULAR ACTIVITIES: </strong>The above named student has not returned all  equipment and property borrowed under his name</p>
                    <p align=center>STATUS: NOT CLEARED</p>
                @else
                    <p><strong>EXTRA-CURRICULAR ACTIVITIES: </strong>The above named student has returned all games equipment and property borrowed under his name</p>
                @endif
            </div>
            <h3><a href="#">Finance</a></h3>
            <div>
                <p><strong>FINANCE: </strong>The above named student is supposed to pay the university Kshs. {{$charge->finance_value}}  before he leaves.</p>
            </div>
            
            <h3><a href="#">Financial Aid Office</a></h3>
            <div>
                @if($charge->financial_aid_value== 0)
                    <p><strong>FINANCIAL AID OFFICE: </strong>The above named student has no qualms with the Financial Aid office
                @else
                    <p><strong>FINANCIAL AID OFFICE</strong><br>Loan Taken <u><i>..change...</i></u> Amount Repaid <u><i>..change..</i></u> Balance <u><i>{{$charge->financial_aid_value}}</i></u><br>Lender <u><i>{{$std->financial_aid}}</i></u> If there is an outstanding balance, show confirmation of registering with CRB <i><u> CRB Choice: ..change..</u></i><br>Name of Credit Reference Bureau Agency ****<br>Date <u><i></i></u> Signature **** (FINANCIAL AID OFFICER).</p>
                @endif
            </div>

        </div>

        <a href="../pdf">PDF</a>
        <a href="auth/logout">Log out</a>
        <br>
        <label style="float:right">DAA-03-01-09/12</label>
        <br>
    </div>
@endsection



