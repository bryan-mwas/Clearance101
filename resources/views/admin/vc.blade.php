@extends('layouts.vcmaster')
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
					<div class="table-responsive" >
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
									<th>{{ $std }}</th>
									<th>{{ $stdFacClear }}</th>
									<th>{{ $stdFacPend }}</th>
								</tr>
								<tr>
									<th>Cafeteria</th>
									<th>{{ $std }}</th>
									<th>{{ $stdCafClear }}</th>
									<th>{{ $stdCafPend }}</th>
								</tr>
								<tr>
									<th>Library</th>
									<th>{{ $std }}</th>
									<th>{{ $stdLibClear }}</th>
									<th>{{ $stdLibPend }}</th>
								</tr>
								<tr>
									<th>Games</th>
									<th>{{ $std }}</th>
									<th>{{ $stdGamClear }}</th>
									<th>{{ $stdGamPend }}</th>
								</tr>
								<tr>
									<th>Sports</th>
									<th>{{ $std }}</th>
									<th>{{ $stdExaClear }}</th>
									<th>{{ $stdExaPend }}</th>
								</tr>
								<tr>
									<th>Fiancial Aid</th>
									<th>{{ $std }}</th>
									<th>{{ $stdFnaClear }}</th>
									<th>{{ $stdFnaPend }}</th>
								</tr>
								<tr>
									<th>finance</th>
									<th>{{ $std }}</th>
									<th>{{ $stdFinClear }}</th>
									<th>{{ $stdFinPend }}</th>
								</tr>
								<tr style="border-top: 2px solid black;">
									<th>Total Students</th>
									<th>{{ $std }}</th>
									<th>{{ $stdTotalClear }}</th>
									<th>{{ $stdTotalPend }}</th>
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
									<th>{{ $stdFit }}</th>
									<th>{{ $stdFitClear }}</th>
									<th>{{ $stdFitPend }}</th>
								</tr>
								<tr>
									<th>SOA</th>
									<th>{{ $stdSoa }}</th>
									<th>{{ $stdSoaClear }}</th>
									<th>{{ $stdSoaPend }}</th>
								</tr>
								<tr>
									<th>SLS</th>
									<th>{{ $stdSls }}</th>
									<th>{{ $stdSlsClear }}</th>
									<th>{{ $stdSlsPend }}</th>
								</tr>
								<tr>
									<th>SBS</th>
									<th>{{ $stdSbs }}</th>
									<th>{{ $stdSbsClear }}</th>
									<th>{{ $stdSbsPend }}</th>
								</tr>
								<tr>
									<th>SFAE</th>
									<th>{{ $stdSfae }}</th>
									<th>{{ $stdSfaeClear }}</th>
									<th>{{ $stdSfaePend }}</th>
								</tr>
								<tr>
									<th>CHT</th>
									<th>{{ $stdCht }}</th>
									<th>{{ $stdChtClear }}</th>
									<th>{{ $stdChtPend }}</th>
								</tr>
								<tr>
									<th>SHSS</th>
									<th>{{ $stdShss }}</th>
									<th>{{ $stdShssClear }}</th>
									<th>{{ $stdShssPend }}</th>
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
									<th># Total Amount Owed</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>Facultys</th>
									<th>{{ $moneyOwedFac }}</th>
								</tr>
								<tr>
									<th>Cafeteria</th>
									<th>{{ $moneyOwedCaf }}</th>
								</tr>
								<tr>
									<th>Library</th>
									<th>{{ $moneyOwedLib }}</th>
								</tr>
								<tr>
									<th>Games</th>
									<th>{{ $moneyOwedGam }}</th>
								</tr>
								<tr>
									<th>Extra Curricular Activities</th>
									<th>{{ $moneyOwedExc }}</th>
								</tr>
								<tr>
									<th>Fiancial Aid</th>
									<th>{{ $moneyOwedFna }}</th>
								</tr>
								<tr>
									<th>finance</th>
									<th>{{ $moneyOwedFin }}</th>
								</tr>
							</tbody>
						</table>
						<hr style="color: blue;">
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