@extends('layouts.superuser')
@section('title','Admin Page')
@section('content')
<div class="container">
  <div class="jumbotron">
  <center><h2><u>SU Clearance Reports</u></h2></center><br>
  <p class="lead">
    Welcome to the Strathmore Online Clearance System. You can download and the Clearance Reports and Financial Report in both PDF and Microsoft Excel format
  </p>
  <hr>
  <div class="row">
    <div class="col-lg-6"><a class="btn btn-md btn-info" href="supdf" role="button">PDF Download</a></div>
    <div class="col-lg-6"><a class="btn btn-md btn-success" href="suexc" role="button">Microsoft Excel Download</a></div>
  </div>
</div>
</div>
@endsection
