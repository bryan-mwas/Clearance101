@extends('master')
@section('title','Admin Page')
@section('content')
    {{--This is student zone! Admin can view all student records!--}}
    <table class="table table-bordered table-responsive">
        <thead><h1>Student Zone</h1></thead>
        <tr>
            <td>Hello</td>
            <td>World</td>
            <td>There</td>
        </tr>
        <tr>
            <td>Hello</td>
            <td>World</td>
            <td>There</td>
        </tr>
        <tr>
            <td>Hello</td>
            <td>World</td>
            <td>There</td>
        </tr>
    </table>

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
                    <td>{{$user->administrator}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->department_name}}</td>
                {{--This code modifies the background of the table cell--}}
                    @if($user->status == 'Active')
                        <td class="bg-info">{{$user->status}}</td>
                    @else
                        <td class="bg-warning">{{$user->status}}</td>
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
                                                    <input type="text" class="form-control" name="adminID" value="{{$user->administrator}}" readonly>
                                                </div>
                                                {{--<div class="form-group">--}}
                                                    <label for="admin" class="col-sm-1 control-label">Name</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="admin_name" value="{{$user->name}}" readonly>
                                                    </div>
                                                {{--</div>--}}
                                            </div>
                                            <div class="form-group">
                                                <label for="dept_name" class="col-sm-2 control-label">Department</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="dept_name" value="{{$user->department_name}}" readonly>
                                                </div>
                                                <label for="status" class="col-sm-1 control-label">Status</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="status" value="{{$user->status}}" readonly>
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
@endsection