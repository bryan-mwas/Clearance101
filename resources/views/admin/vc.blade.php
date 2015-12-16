@extends('layouts.master')
@section('content')

<div class="container" style="background-color: #fff">
	<br><br>
	<div>
		<center><u><h3>Clearance Report</h3></u></center>
	</div>
	<br><br>
	<div id="view">
		<div>
			<input type="button" value="PDF"> <input type="button" value="MS Excel">
		</div><br><br>
		<div>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">Clear Information</a></li>
				<li role="presentation"><a href="#financial" aria-controls="financial" role="tab" data-toggle="tab">Financial Information</a></li>
			</ul>
			
			<!-- Tab panes -->
			<br><br>
			<div class="tab-content">
				<!--tab pane for general information-->
				<!--start gen tab-->
				<div role="tabpanel" class="tab-pane active" id="general">
					<div class="table-responsive">
						<table class=" table table-hover table-bordered" >
							<thead bgcolor="#FF9900">
								<tr>
									<th>Department Name</th>
									<th># Requests from students</th>
									<th># cleared Student</th>
									<th># Pending Students</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>Facultys</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>Cafeteria</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>Library</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>Games</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>Sports</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>Fiancial Aid</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>finance</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
							</tbody>
						</table>
						
						<hr ><br><br>
						<center><h4>Faculty</h4></center>
						<table class=" table table-hover table-bordered" >
							<thead bgcolor="#FF9900">
								<tr>
									<th>Faculty Name</th>
									<th># Requests from students</th>
									<th># cleared Student</th>
									<th># Pending Students</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>FIT</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>SOA</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>SLS</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>SBS</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>SFAE</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>CHT</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
								<tr>
									<th>SHSS</th>
									<th>200</th>
									<th>130</th>
									<th>70</th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!--end gen tab-->
				
				<!-- tab pane for financial information -->
				<!--start fin tab-->
				<div role="tabpanel" class="tab-pane" id="financial">
					<div class="table-responsive">
						<table class=" table table-hover table-bordered" >
							<thead bgcolor="#FF9900">
								<tr>
									<th>Department Name</th>
									<th># Total Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>Facultys</th>
									<th>200</th>
								</tr>
								<tr>
									<th>Cafeteria</th>
									<th>200</th>
								</tr>
								<tr>
									<th>Library</th>
									<th>200</th>
								</tr>
								<tr>
									<th>Games</th>
									<th>200</th>
								</tr>
								<tr>
									<th>Sports</th>
									<th>200</th>
								</tr>
								<tr>
									<th>Fiancial Aid</th>
									<th>200</th>
								</tr>
								<tr>
									<th>finance</th>
									<th>200</th>
								</tr>
							</tbody>
						</table>
						
						
						<hr style="color: blue;">
						<br>
						<center><h4>Faculty</h4></center>
						<table class=" table table-hover table-bordered" >
							<thead bgcolor="#FF9900">
								<tr>
									<th>Faculty Name</th>
									<th>Total Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>FIT</th>
									<th>200</th>
								</tr>
								<tr>
									<th>SOA</th>
									<th>200</th>
								</tr>
								<tr>
									<th>SLS</th>
									<th>200</th>
								</tr>
								<tr>
									<th>SBS</th>
									<th>200</th>
								</tr>
								<tr>
									<th>SFAE</th>
									<th>200</th>
								</tr>
								<tr>
									<th>CHT</th>
									<th>200</th>
								</tr>
								<tr>
									<th>SHSS</th>
									<th>200</th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!--end fin pan-->
			</div>
		</div>
	</div>
</div>
<script>
	$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
 @endsection