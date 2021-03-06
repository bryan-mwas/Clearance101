@extends('layouts.master')
@section('content')

  <div class="container" style="background-color: #fff">
    <br><br>
    <div>
    	<center><u><H3>FINANCE DEPARTMENT</H3></u></center>
      @foreach($userInformation as $infor)
      <center>(<i><label style="color: gray;">{{ $staffInformation['names'] }}</label></i>)</center>
      @endforeach
    </div>
    <br><br>
	  <ul class="nav nav-tabs" role="tablist">
		  <li role="presentation" class="active"><a href="#urgent" aria-controls="general" role="tab" data-toggle="tab">Pending Students</a></li>
		  <li role="presentation"><a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Cleared Students</a></li>
	  </ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="urgent">
		<div id="view">
      <!-- notification script -->
      <div class="row" id="notification_message"><center><i><label style="color: gray; font-size: 14px;"> {{ $message }} </label></i><class=" table table-hover table-bordered" ></div>
        <table class=" table table-hover table-bordered">
        <thead bgcolor="#FF9900">
				<tr>
					<th>Registration Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Faculty</th>
					<th>Course</th>
					<th style="border-right:hidden"></th>
				</tr>
				</thead>
				<tbody>
				@foreach($students as $student)
					<tr>
						<td>{{$student->studentNo}}</td>
						<td>{{$student->fname }}</td>
						<td>{{$student->lname }}</td>
						<td>{{$student->faculty }}</td>
						<td>{{$student->course }}</td>
						<td>
							<!-- button -->
							<button title="View student" type="button" class="btn btn-sm btn warning" data-toggle="modal" data-target="#myModal{{$student->studentNo}}">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
							<!-- end button -->
						</td>

						<!-- Modal -->
						<div class="modal fade" id="myModal{{$student->studentNo}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel{{$student->studentNo}}">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>			</button>
										<h4 class="modal-title" id="myModalLabel{{$student->studentNo}}">CAFETERIA DEPARTMENT</h4>
									</div>
									<div class="modal-body">
										<!--start student information display-->
										<div class="">
											<label for="name"> STUDENT NAME</label>
											<input class="form-control edit-input" type="text" value="{{$student-> sname}}, {{$student-> fname}}, {{$student-> lname}}" readonly><br>
											<div class="row">
												<div class="col-md-6">
													<label for="name"> REGISTRATION NUMBER</label>
													<input class="form-control edit-input" type="text" value="{{$student->studentNo}}" readonly>
												</div>

												<div class="col-md-6">
													<label for="name"> TEL. NO</label>
													<input class="form-control" type="text" value="{{$student-> tel_no}}" readonly>
												</div>
											</div><br>

											<div class="row">
												<div class="col-md-6">
													<label for="name"> POSTAL ADDRESS</label>
													<input class="form-control" type="text" value="{{$student->postal_address}}" readonly>
												</div>

												<div class="col-md-6">
													<label for="name"> EMAIL ADRESS</label>
													<input class="form-control" type="text" value="{{$student->email}}" readonly>
												</div>
											</div><br>

											<div class="row">
												<div class="col-md-6">
													<label for="name"> FACALTY/DEPARTMENT</label>
													<input class="form-control" type="text" value="{{$student->faculty}}" readonly>
												</div>

												<div class="col-md-6">
													<label for="name"> COURSE</label>
													<input class="form-control" type="text" value="{{$student->course}}" readonly>
												</div>
											</div>
										</div>
										<!--end student information display-->
										<!-- display form -->
										<form id="financeClearForm" method="post" action="{{ action('FinanceController@clear') }}">
											<h3><b>FINANCE</b></h3>
											<div>
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="magic_value" value="1">
												<input type="hidden" name="regNo" value="{{$student->studentNo}}">
                        <div class="row">
                          <div class="col-sm-6">
                            <p>The above named student is supposed to pay the university</p>
                          </div>
                          <div class="col-sm-4">
                            <div class="input-group"><div class="input-group-addon">Kshs</div>
    													<input type="text" class="form-control" placeholder="Enter Amount Owed" name="amount" id="clearAmount" placeholder="Amount">
    													<div class="input-group-addon">.00</div>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            before he leaves.
                          </div><br>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <span class="error_report" id="amount_error_message"></span>
                          </div>
                        </div>

                        Cleared by :  {{ $staffInformation['names'] }}
                        <input type="hidden" name="signedBy" value="{{ $staffInformation['names'] }}">
											   Date: <u>{!! date('Y-m-d') !!}</u>
                         <input type="hidden" name="signedAt" value="{!! date('Y-m-d') !!}">

											<div class="modal-footer">
												<button title="Cancel"type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<input title="Save changes and Clear student" type="submit" class="btn btn-primary" value="Save changes">
											</div>
										</form>
										<!-- end form display -->
									</div>
								</div>
							</div>
						</div>
					</tr>
				@endforeach
        <tr><td style="border: 1px;"><input type="hidden"></td></tr>
        <tr><td style="border: 1px;"><input type="hidden"></td></tr>
				</tbody>
				{!! $students->render() !!}
			</table>
		</div>
		</div>
        <!--pending tab-->
		<div role="tabpanel" class="tab-pane" id="pending" style="font-family: 'Segoe UI'">
			<div id="view">
        <div class="row" id="notification_message"><center><i><label style="color: gray; font-size: 14px;">These students have already been cleared. It is up to the student to pay the amount he or she owes the school. </label></i><class=" table table-hover table-bordered" ></center></div>
				<table class=" table table-hover table-bordered" >
					<thead bgcolor="#FF9900">
					<tr>
						<th>Registration Number</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Faculty</th>
						<th>Course</th>
						<th style="border-right:hidden"></th>
					</tr>
					</thead>
					<tbody>
					@foreach($pending as $student)
						<tr>
							<td>{{$student->studentNo}}</td>
							<td>{{$student->fname }}</td>
							<td>{{$student->lname }}</td>
							<td>{{$student->faculty }}</td>
							<td>{{$student->course }}</td>
							<td>
								<!-- button -->
								<button title="View student" type="button" class="btn btn-sm btn warning" data-toggle="modal" data-target="#myModal{{$student->studentNo}}">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</button>
								<!-- end button -->
							</td>

							<!-- Modal -->
							<div class="modal fade" id="myModal{{$student->studentNo}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel{{$student->studentNo}}">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>			</button>
											<h4 class="modal-title" id="myModalLabel{{$student->studentNo}}">CAFETERIA DEPARTMENT</h4>
										</div>
										<div class="modal-body">
											<!--start student information display-->
											<div class="">
												<label for="name"> STUDENT NAME</label>
												<input class="form-control edit-input" type="text" value="{{$student-> sname}}, {{$student-> fname}}, {{$student-> lname}}" readonly><br>
												<div class="row">
													<div class="col-md-6">
														<label for="name"> REGISTRATION NUMBER</label>
														<input class="form-control edit-input" type="text" value="{{$student->studentNo}}" readonly>
													</div>

													<div class="col-md-6">
														<label for="name"> TEL. NO</label>
														<input class="form-control" type="text" value="{{$student-> tel_no}}" readonly>
													</div>
												</div><br>

												<div class="row">
													<div class="col-md-6">
														<label for="name"> POSTAL ADDRESS</label>
														<input class="form-control" type="text" value="{{$student->postal_address}}" readonly>
													</div>

													<div class="col-md-6">
														<label for="name"> EMAIL ADRESS</label>
														<input class="form-control" type="text" value="{{$student->email}}" readonly>
													</div>
												</div><br>

												<div class="row">
													<div class="col-md-6">
														<label for="name"> FACALTY/DEPARTMENT</label>
														<input class="form-control" type="text" value="{{$student->faculty}}" readonly>
													</div>

													<div class="col-md-6">
														<label for="name"> COURSE</label>
														<input class="form-control" type="text" value="{{$student->course}}" readonly>
													</div>
												</div>
											</div>
											<!--end student information display-->
											<!-- display form -->
											<form method="post" action="{{ action('FinanceController@update') }}">
												<h3><b>FINANCE</b></h3>
												<div>
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="hidden" name="magic_value" value="0">
													<input type="hidden" name="regNo" value="{{$student->studentNo}}">
												  <!--start statement summary-->
                            <div class="">
                              <hr>
                              <!-- help -->
                              <div class="row">
      													<div class="col-md-4">
      														<label for="name">Name of Department</label>
      													</div>
      													<div class="col-md-1">
      														<label for="">Current Amount</label>
      													</div>
                                <div class="col-md-4">
      														<label for="">Amount Payed</label>
      													</div>
      												</div><br>
                              <!-- depts -->
                              <div class="row">
      													<div class="col-md-4">
      														<label for="name">School</label>
      													</div>
      													<div class="col-md-1">
      														<label for="">{{$student->department_value}}</label>
      													</div>
                                <div class="col-md-4">
                                  <div class="input-group"><div class="input-group-addon">Kshs</div>
          													<input class="form-control" placeholder="{{$student->department_value}}" type="text" id="finPendschool" name="school">
          													<div class="input-group-addon">.00</div>
                                  </div>
      													</div>
                                <div class="col-sm-2">
                                  <span class="error_report" id="finPendschool_error_message"></span>
                                </div>
      												</div><br>
                              <!-- caft -->
                              <div class="row">
      													<div class="col-md-4">
      														<label for="name">Cafeteria</label>
      													</div>
      													<div class="col-md-1">
      														<label for="">{{$student->cafeteria_value}}</label>
      													</div>
                                <div class="col-md-4">
                                  <div class="input-group"><div class="input-group-addon">Kshs</div>
          													<input class="form-control" placeholder="{{$student->cafeteria_value}}" id="cafPendschool" type="text" name="cafeteria">
          													<div class="input-group-addon">.00</div>
                                  </div>
      													</div>
                                <div class="col-sm-2">
                                  <span class="error_report" id="finPendcaft_error_message"></span>
                                </div>
      												</div><br>
                              <!-- lib -->
                              <div class="row">
      													<div class="col-md-4">
      														<label for="">Library</label>
      													</div>
      													<div class="col-md-1">
      														<label for="">{{$student->library_value}}</label>
      													</div>
                                <div class="col-md-4">
                                  <div class="input-group"><div class="input-group-addon">Kshs</div>
          													<input class="form-control" placeholder="{{$student->library_value}}" type="text" name="library" id="finPendLib">
          													<div class="input-group-addon">.00</div>
                                  </div>
      													</div>
                                <div class="col-sm-2">
                                  <span class="error_report" id="finPendLib_error_message"></span>
                                </div>
      												</div><br>
                              <!-- FinA -->
                              <div class="row">
      													<div class="col-md-4">
      														<label for="">Financial Aid</label>
      													</div>
      													<div class="col-md-1">
      														<label for="">{{$student->financial_aid_value}}</label>
      													</div>
                                <div class="col-md-4">
                                  <div class="input-group"><div class="input-group-addon">Kshs</div>
          													<input class="form-control" placeholder="{{$student->financial_aid_value}}" type="text" name="financialAid" id="finPendFinAid">
          													<div class="input-group-addon">.00</div>
                                  </div>
      													</div>
                                <div class="col-sm-2">
                                  <span class="error_report" id="finPendFinAid_error_message"></span>
                                </div>
      												</div><br>
                              <!-- fin -->
                              <div class="row">
      													<div class="col-md-4">
      														<label for="">Finance</label>
      													</div>
      													<div class="col-md-1">
      														<label for="">{{$student->finance_value}}</label>
      													</div>
                                <div class="col-md-4">
                                  <div class="input-group"><div class="input-group-addon">Kshs</div>
          													<input class="form-control" placeholder="{{$student->finance_value}}" type="text" name="finance" id="finPendFin">
          													<div class="input-group-addon">.00</div>
                                  </div>
      													</div>
                                <div class="col-sm-2">
                                  <span class="error_report" id="finPendFin_error_message"></span>
                                </div>
      												</div><br>
                              <!-- total -->
                              <div class="row">
      													<div class="col-md-4">
      														<label for="name">Total</label>
      													</div>
      													<div class="col-md-1">
      														<label for="name">{{$student->total}}</label>
      													</div>
                                <div class="col-md-4">
                                  <div class="input-group"><div class="input-group-addon">Kshs</div>
          													<input class="form-control" type="text" value="{{$student->total}}" readonly>
          													<div class="input-group-addon">.00</div>
                                  </div>
      													</div>
      												</div><br>
                              <!-- end report form -->
                            </div>
                          <!--end statement summary-->
												</div>
												<div class="modal-footer">
													<button title="Cancel"type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input title="Save changes and Clear student" type="submit" class="btn btn-primary" value="Update Balance">
												</div>
											</form>
											<!-- end form display -->
										</div>

									</div>
								</div>
							</div>
						</tr>
					@endforeach
          <tr><td style="border: 1px;"><input type="hidden"></td></tr>
          <tr><td style="border: 1px;"><input type="hidden"></td></tr>
					</tbody>
					{!! $students->render() !!}
				</table>
			</div>
		</div>
	</div>
  </div>
@endsection
