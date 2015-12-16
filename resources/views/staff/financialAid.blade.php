@extends('layouts.master')
@section('content')
  <div class="container" style="background-color: #fff">
    <br><br>
    <div>
    	<center><u><H3>FINANCIAL-AID DEPARTMENT</H3></u></center>
    </div>
    <br><br>
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
		        <!-- buttons -->
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
				        <h4 class="modal-title" id="myModalLabel{{$student->studentNo}}">FINANCIAL AID OFFICE</h4>
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
				      		 <form id="fa" method="post" action="{{ action('FinancialAidController@clear') }}">
								<h3><b>FINANCIAL AID OFFICE</b></h3>
								<div>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="regNo" value="{{$student->studentNo}}">
									<p><br>
									
										<div class="">
										Loan Taken<input type="text" placeholder="Please Enter the amount originaly borrowed" class="form-control" placeholder="Amount" name="amountTaken" id="loan">
										Amount Repaid<input type="text" class="form-control" placeholder="Please enter the Amount repaid" name="amountRepaid" id="paid">
										Balance<input type="text" class="form-control" placeholder="Balance" name="balance" id="balance">
										<br>
										Lender <input type="text" class="form-control" placeholder="Please state the lender" name="lender"> <br>
										If there is an outstanding balance, show confirmation of registering with CRB <br> <input type="radio" class="" name="crbChoice" id="choiceYes" value="Yes"> Yes <input type="radio" class="" name="crbChoice" id="choiceNo" value="No"> No <br>
										Name of Credit Reference Bureau Agency <input type="text" class="form-control" placeholder="Please enter the name of Credit Reference Bureau Agency" name="crbName" id="crbName">.</p><br>
									Date: <u>{!! date('Y-m-d') !!}</u> 
								</div>
								<div class="modal-footer">
							        <button title="Cancel" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
		</tbody>
		{!! $students->render() !!}
	</table>
	</div>
  </div>	

  <script>
  	$(document).ready(function(){
  		var bal = 0;
    	var loan = 0;
    	var paid = 0;
    	$( "#loan" ).keyup(function(){
    		loan = $(this).val();
    		bal = (loan - paid);
  			$('#balance').val(bal);
  		}).keyup();
  		$( "#paid" ).keyup(function(){
    		paid = $(this).val();
    		bal = (loan - paid);
  			$('#balance').val(bal);
  		}).keyup();

  		$("#choiceNo, #choiceYes").change(function(){
    		$("#crbName").val("").attr("disabled",true);
    		if($("#choiceYes").is(":checked")){
    			$("#crbName").removeAttr("disabled");
    			$("#crbName").focus();
    		}else if($('#choiceNo').is(':checked')){
    			$("#crbName").val("").attr("disabled",true);
    		}
    	});

	});
	// JQuerz.validator.setDefaults({
	// 	debug: true,
	// 	success: "valid"
	// });
	// $("#fa").validate({
	// 	rules: {
	// 		amountTaken:{
	// 			number: true
	// 	 	}
	// 	 	amountRepaid: {
	// 	 		number: true
	// 	 	}
	// 	 	balance: {
	// 	 		number: true
	// 	 	}
	// 	}
	// });
  </script>
@endsection