@extends('layouts.master')
@section('title','Admin Page')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Administrator <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Delgation</a></li>
            <li><a href="#">Student Reports</a></li>
            <li><a href="#">Export</a></li>
      </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      {{--This is student zone! Admin can view all student records!--}}
      {{--Delegation Zone. Allowing inheritance of the designated admin roles--}}
          <input type="hidden" name="_token" value="{{ csrf_token()}}">
          <table class="table table-bordered table-responsive" style="font-family:'Segoe UI'">
              <thead><h1>Delegation Zone</h1></thead>
              <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Department/Faculty</th>
                  <th>Status</th>
                  <th>Assign</th>
              </tr>
              <tr>
                  @foreach ($users as $user)
                      <td>{{$user->payroll_numebr}}</td>
                      <td>{{$user->names}}</td>
                      <td>{{$user->department}}</td>
                  {{--This code modifies the background of the table cell--}}
                      @if($user->state == 'Authorised')
                          <td class="bg-info">{{$user->state}}</td>
                      @else
                          <td class="bg-warning">{{$user->state}}</td>
                      @endif
                      <td>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal{{$user->administrator}}">
                              Assign <span class="glyphicon glyphicon-cog"></span>
                          </button>
                          <!-- Modal -->
                          <div class="modal fade" id="myModal{{$user->administrator}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$user->administrator}}">
                              <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" id="myModalLabel{{$user->administrator}}">Assignment to Clear</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form method="post" action="/mwas" class="form-horizontal">
                                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                                              <div class="form-group">
                                                  <label for="adminID" class="col-md-2 control-label">Admin ID</label>
                                                  <div class="col-sm-4">
                                                      <input type="text" class="form-control" name="adminID" value="{{$user->payrollNo}}" readonly>
                                                  </div>
                                                  {{--<div class="form-group">--}}
                                                      <label for="admin" class="col-sm-1 control-label">Name</label>
                                                      <div class="col-sm-4">
                                                          <input type="text" class="form-control" name="admin_name" value="{{$user->names}}" readonly>
                                                      </div>
                                                  {{--</div>--}}
                                              </div>
                                              <div class="form-group">
                                                  <label for="dept_name" class="col-sm-2 control-label">Department</label>
                                                  <div class="col-sm-4">
                                                      <input type="text" class="form-control" name="dept_name" value="{{$user->department}}" readonly>
                                                  </div>
                                                  <label for="status" class="col-sm-1 control-label">Status</label>
                                                  <div class="col-sm-4">
                                                      <input type="text" class="form-control" name="status" value="{{$user->state}}" readonly>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <div class="col-sm-offset-2 col-sm-10">

                                                  </div>
                                              </div>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Assign</button>
                                      </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </td>
              </tr>
              @endforeach
          </table>
    </div>
  </div>
</div>
@endsection
