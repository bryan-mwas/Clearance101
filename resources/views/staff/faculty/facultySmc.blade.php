<!DOCTYPE HTML>
<html>
<head>
	<title>Clearance Form</title>
      <meta charset="UTF-8">
      <meta name="description" content="Strathmoe University Gaduation clearance web interface">
      <meta name="author" content="Angela Namikoye, Brian Mwathi, Brian Phiri">
      
      <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
      <link rel="stylesheet" href="css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">

      <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</head>
<body style="background-color: #F2F2F2;">
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Clearance</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Strathmore University</a></li>
            <li>&nbsp;</li>
            <li><a href="#">Help</a></li>
            <li><a href="">Home</a></li>
            <li><a href="#">Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <!-- end nav -->
  <div class="container" style="background-color: #fff">
    <br><br>
    <div>
    	<H3>SMC DEPARTMENT</H3>
    </div>
    <br><br>
    <div id="view">
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
				        <h4 class="modal-title" id="myModalLabel{{$student->studentNo}}">Faculty</h4>
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
								<input class="form-control" type="text" value="{{$student->tel_no}}" readonly>
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
				      	<form method="post" action="{{ action('FacultyController@clear') }}"> <!-- change that-->
							<h3><b>FIT</b></h3>
							<div>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="regNo" value="{{$student->studentNo}}">
								<p>The above named student has handed over to me in good order all keys, equipment and University property for which he/she 
									was responsible and which is under my Department with the exception of-</p>
									<input type="text" class="form-control" name="comment" placeholder="N/A">.<br>
										<p>Value: </p><input type="text" class="form-control" name="amount" placeholder="N/A">
									Date: <u>{!! date('Y-m-d') !!}</u>  
								</div>
								<div class="modal-footer">
							        <button title="close modal"type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        <input title="clear student" type="submit" class="btn btn-primary" value="Save changes">
							    </div>
							</div>
						</form>
					  <!-- end form display -->
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
        	 <footer class="footer navbar-fixed-bottom" style="background-color: #E6E6FA;">
            <div class="footer-main">
               <div class="container-fluid">
                   <div class="row-fluid">
                      <div class="span4">
                          <div  class="infoarea">
                            <div  class="footer-logo">
                              <a  href="https://strathmore.edu">
                                  <img  src="//elearning.strathmore.edu/pluginfile.php?file=%2F1%2Ftheme_klass%2Ffooterlogo%2F1446031855%2FPicture16.png" alt="strathmore logo" height="80" width="183">
                              </a>
                            </div>
                              <p>Strathmore university online graduation clearance form</p>
                          </div>
                      </div>
                         <div class="span2" style="float:right;">
                             <p style="color: #B0C4DE;">DAA-03-01-09/12</p>
                         </div>
                         <div class="span3"></div>
                   </div>
                </div>
            </div>
          <div class="footer-foot">
                <div class="container-fluid">
                      <p>Copyright © {{ date('y-m-d') }} - <a href="http://www.strathmore.edu/en/">Strathmore University</a>. All Rights Reserved.</p>
                </div>
          </div>
      </footer>
</body>
</html>