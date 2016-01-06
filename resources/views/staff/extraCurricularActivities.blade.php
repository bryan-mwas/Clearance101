@extends('layouts.master')
@section('content')

  <div class="container" style="background-color: #fff">
    <br><br>
    <div>
    	<center><u><H3>EXTRA-CURRICULAR ACTIVITIES DEPARTMENT</H3></u></center>
    </div>
    <br><br>
	  <!--Nav. Tabs-->
	  <ul class="nav nav-tabs" role="tablist">
		  <li role="presentation" class="active"><a href="#urgent" aria-controls="general" role="tab" data-toggle="tab">Urgent!Clear Now</a></li>
		  <li role="presentation"><a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Pending Students</a></li>
	  </ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="urgent">
				<div id="view">
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
									</button><!-- buton to fill in form -->
									<!-- end button -->
								</td>

								<!-- Modal -->
								<div class="modal fade" id="myModal{{$student->studentNo}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel{{$student->studentNo}}">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>			</button>
												<h4 class="modal-title" id="myModalLabel{{$student->studentNo}}">EXTRA-CURRICULAR ACTIVITIES</h4>
											</div>
											<div class="modal-body">
												<!--start student information display-->
												<div class="">
													<label for="name"> STUDENT NAME</label>
													<input class="form-control edit-input" type="text" value="{{$student-> sname}}, {{$student->fname}}, {{$student-> lname}}" readonly><br>
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
												<form method="post" action="{{ action('ExtraCurricularActivitiesController@clear') }}">
													<h3><b>EXTRA-CURRICULAR ACTIVITIES</b></h3>
													<div>
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="magic_value" value="1">
														<input type="hidden" name="regNo" value="{{$student->studentNo}}">
														<p>The above named student has returned all games equipment and property borrowed under his name.</p>
														Date: <u>{!! date('Y-m-d') !!}</u>
													</div>
													<div class="modal-footer">
														<button title="Cancel"type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<input title="Clear student" type="submit" class="btn btn-primary" value="Save changes">
													</div>
												</form>
												<!-- end form display -->
											</div>
										</div>
									</div>
								</div>
							</tr>
						@endforeach
						</tbody>
						{!! $students->render() !!}
					</table>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="pending">
				<div id="view">
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
									</button><!-- buton to fill in form -->
									<!-- end button -->
								</td>

								<!-- Modal -->
								<div class="modal fade" id="myModal{{$student->studentNo}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel{{$student->studentNo}}">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>			</button>
												<h4 class="modal-title" id="myModalLabel{{$student->studentNo}}">EXTRA-CURRICULAR ACTIVITIES</h4>
											</div>
											<div class="modal-body">
												<!--start student information display-->
												<div class="">
													<label for="name"> STUDENT NAME</label>
													<input class="form-control edit-input" type="text" value="{{$student-> sname}}, {{$student->fname}}, {{$student-> lname}}" readonly><br>
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
												<form method="post" action="{{ action('ExtraCurricularActivitiesController@clear') }}">
													<h3><b>EXTRA-CURRICULAR ACTIVITIES</b></h3>
													<div>
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="magic_value" value="0">
														<input type="hidden" name="regNo" value="{{$student->studentNo}}">
														<p>The above named student has returned all games equipment and property borrowed under his name.</p>
														Date: <u>{!! date('Y-m-d') !!}</u>
													</div>
													<div class="modal-footer">
														<button title="Cancel"type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<input title="Clear student" type="submit" class="btn btn-primary" value="Save changes">
													</div>
												</form>
												<!-- end form display -->
											</div>
										</div>
									</div>
								</div>
							</tr>
						@endforeach
						</tbody>
						{!! $students->render() !!}
					</table>
				</div>
			</div>
		</div>

  </div>	
@endsection