@extends('layouts.superuser')
@section('title','Admin Page')
@section('content')

<form class="" role="search" method="post" action="{{ action('SuperUser@studentSearch') }}">
  <input type="hidden" name="_token" value="{{ csrf_token()}}">
  <div class="form-group" style="width: 200px">
    <input type="text" class="form-control" name="search" placeholder="Search by Serial Number">
  </div>
  <button type="submit" class="btn btn-default btn-sm">search</button>
</form>

<table class="table table-hover">
  <thead>
    <tr>
      <td>Student Number</td><td>Names</td><td>School</td><td>Course</td><td>Action</td>
    </tr>
  </thead>
  <tbody>
    @foreach( $students as $student)
      <tr>
        <td>{{$student->studentNo}}</td>
        <td>{{$student->lname}}</td>
        <td>{{$student->faculty}}</td>
        <td>{{$student->course}}</td>
        <td><input type="button" class="btn btn-warning" name="name" value="View" data-toggle="modal" data-target="#myModal{{$student->studentNo}}"></td>
        <!-- Modal -->
        <div class="modal fade" id="myModal{{$student->studentNo}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel{{$student->studentNo}}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>	</button>
                        <h4 class="modal-title" id="myModalLabel{{$student->studentNo}}">STUDENT REPORT</h4>
                    </div>
                    <div class="modal-body">
                        <!--start student information display-->
                        <div class="">
                            <label for="name"> STUDENT NAME</label>
                            <input class="form-control edit-input" type="text" value="{{$student-> sname}}, {{$student-> fname}} {{$student-> lname}}" readonly><br>
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
                                    <label for="name"> FACULTY/DEPARTMENT</label>
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
                        <form id="caf" method="post" action="{{ action('ViewsController@studentPdf') }}">
                          <input type="hidden" name="_token" value="{{ csrf_token()}}">
                          <input type="hidden" name="student" value="{{$student->studentNo}}">
                            <div class="modal-footer">
                                <button title="Cancel"type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input title="Download student's PDF report" type="submit" class="btn btn-warning" value="PDF">
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
</table>

@endsection
