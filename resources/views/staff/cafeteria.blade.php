@extends('layouts.master')
@section('content')
  <div class="container" style="background-color: #fff">
    <br><br>
    <div>
    	<center><u><H3>CAFETERIA DEPARTMENT</H3></u></center>
      @foreach($userInformation as $infor)
      <center>(<i><label style="color: gray;"> {{ $infor->lname }} , {{ $infor->fname }} </label></i>)<center>
      @endforeach
    </div>
    <br><br>
      <div id="view">
        <div class="row" id="notification_message">
          <center><i><label style="color: gray; font-size: 14px;"> {{ $message }} </label></i></center>
        </div>
          <table class=" table table-hover table-bordered" >
              <thead bgcolor="#FF9900">
              <tr>
                  <th>Registration Number</th>
                  <th>First Name</th>
                  <th>Last</th>
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
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>	</button>
                                      <h4 class="modal-title" id="myModalLabel{{$student->studentNo}}">CAFETERIA DEPARTMENT</h4>
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
                                      <form id="caf" method="post" action="{{ action('CafeteriaController@clear') }}">
                                          <h3><b>CAFETERIA DEPARTMENT</b></h3>
                                          <div>
                                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                              <input type="hidden" name="regNo" value="{{$student->studentNo}}">
                                              <p>The above named student has accounted for all cutlery and crockery items on his/her charge, with the
                                                exception of -</p>
                                              <input type="text" class="form-control" id="cafeteriaComment" name="comment" placeholder="Please enter any items not returned (if any)">
                                              <br>
                                              <div class="row">
                                                <div class="col-sm-6">
                                                  <span class="error_report" id="cafeteriaComment_error_message"></span>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-sm-1">
                                                  <p>Value: </p>
                                                </div>
                                                <div class="col-sm-6">
                                                  <div class="input-group"><div class="input-group-addon">Kshs</div>
                          													<input type="text" class="form-control" id="cafeteriaValue" name="amount" placeholder="Please Enter Amount Owed" >
                          													<div class="input-group-addon">.00</div>
                                                  </div>

                                                </div>
                                                <div class="col-sm-4">
                                                  <br><span class="error_report" id="cafeteriaValue_error_message"></span>
                                                </div>
                                              </div>
                                              Date: <u>{!! date('Y-m-d') !!}</u>
                                          </div>
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
  <script>
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');
</script>
 @endsection
