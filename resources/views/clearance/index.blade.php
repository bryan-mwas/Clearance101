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
                        with the exception of <u><b>{{$comment->department}}</b></u> worth <u><b>Ksh. {{$charge->department_value}}</b></u></p>
                @endif
            </div>
            <h3><a href="#">Cafeteria Department</a></h3>
            <div>
                <p><strong>CAFETERIA DEPARTMENT: </strong>The above named student has accounted for all cutlery and crockery item on his/her charge
                    @if($charge->cafeteria_value!==0)
                        , with the exception of charges worth <u><b>Ksh. {{$charge->cafeteria_value}}</b></u> because he/she <u><b>{{$comment->cafeteria}}</b></u></p>
                @endif
            </div>
            <h3><a href="#">Library</a></h3>
            <div>
                <p><strong>LIBRARY: </strong>The above named student has accounted for all the library items on his/her charge
                    @if($charge->library_value!==0)
                        with the exception of <u><b>{{$comment->library}}</b></u> valued at <u><b>Ksh. {{$charge -> library_value}}</b></u></p>
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
                <p><strong>FINANCE: </strong>The above named student is supposed to pay the university <b><u> Kshs.{{$charge->finance_value}}</u></b>  before he leaves.</p>
            </div>
            
            <h3><a href="#">Financial Aid Office</a></h3>
            <div>
                @if($charge->financial_aid_value== 0)
                    <p><strong>FINANCIAL AID OFFICE: </strong>The above named student has no qualms with the Financial Aid office
                @else
                    <p><strong>FINANCIAL AID OFFICE</strong><br>
                        Loan Taken: <u><b>{{$comment->loan}}</b></u><br>
                        Amount Repaid: <u><b>{{$comment->repaid}}</b></u><br>
                        Balance: <u><b>{{$charge->financial_aid_value}}</b></u><br>
                        Lender: <u><b>{{$std->financial_aid}}</b></u>
                        If there is an outstanding balance, show confirmation of registering with CRB <i><u>
                        CRB Choice: ..change..</u></i><br>Name of Credit Reference Bureau Agency ****<br>
                        Date <u><i></i></u> Signature(Stamp) **** (FINANCIAL AID OFFICER).</p>
                @endif
            </div>
        </div><br>
        <!--Fancy links!-->
        <ul class="nav nav-pills">
            @if($charge->queueFlag == 7)
            <li role="presentation" class="active"><a href="../pdf"><span class="glyphicon glyphicon-floppy-save"></span> <span style="font-family: 'Segoe UI';font-size: 115%">PDF</span></a></li>
            @else
            <li role="presentation" class="disabled"><a href="#"><span class="glyphicon glyphicon-floppy-save"></span> <span style="font-family: 'Segoe UI';font-size: 115%">PDF</span></a></li>
            @endif
            <li role="presentation"><a href="auth/logout"><span class="glyphicon glyphicon-log-out"></span> <span style="font-family: 'Segoe UI';font-size: 115%">Log out</span></a></li>
        </ul>
        <br>
        <label style="float:right">DAA-03-01-09/12</label>
        <br>
    </div>
@endsection



