@extends('master')

@section('title','Register')

@section('content')
    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <center><h3 class="panel-title">Registration Form</h3></center>
                </div>
                <div class="panel-body">
                    {{--Panel content containing authentication form--}}
                    <form method="POST" action="/auth/register" class="form-horizontal" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="std_studentNo" class="col-md-4 control-label">UserID</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="regNo" placeholder="Registration/Admission Number">
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="password" class="col-md-4 control-label">e-mail</label>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<input type="email" class="form-control" name="email" placeholder="e-mail">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password Confirmation</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-10">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
@endsection