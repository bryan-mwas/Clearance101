@extends('layouts.superuser')
@section('title','Admin Page')
@section('content')

<form class="" role="search" method="post" action="{{ action('SuperUser@search') }}" >
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group" style="width: 200px">
    <input type="text" class="form-control" name="searchEmp" placeholder="Search by ID">
  </div>
  <button type="submit" class="btn btn-default btn-sm">search</button>
</form>
<hr>

<form class="" role="authorize" method="post" action="{{ action('SuperUser@authorize') }}" >
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Staff ID</label>
    <input type="text" class="form-control" name="payrollNo" value="{{$staffInformation['employeeNo']}}" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Names</label>
    <input type="text" class="form-control" name="names" value="{{$staffInformation['names']}}" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Email</label>
    <input type="text" class="form-control" name="email" value="{{$staffInformation['email']}}" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Department</label>
    <input type="text" class="form-control" name="department" value="{{$staffInformation['departmentShortName']}}" readonly>
  </div>
  <input type="submit" name="name" value="Authorize">
</form>

@endsection
