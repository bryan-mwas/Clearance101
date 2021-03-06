@extends('master')

@section('title','Sign in')

@section('content')
    <br>
    <div class="row" style="font-family: 'Segoe UI'">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign In</h3>
                </div>
                <div class="panel-body">
                    {{--Panel content containing authentication form--}}
                    <form method="POST" action="/auth/login" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="regNo" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="regNo" placeholder="Enter your registration number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button id="element" type="submit" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="right" data-content="Invalid username or password!">Sign in</button>
                                   <br><br>
                                <!-- <a href="/auth/register"><u>First time to interact with the system? Click here pal.</u></a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    <br>
    @if(Session::has('flash_message'))
        <div class="alert alert-success col-md-8 col-md-offset-2" role="alert" style="font-family: 'Trebuchet MS';font-size: large">
            <center>{{Session::get('flash_message')}}</center>
        </div>
    @endif
    @if($errors->any())

       {{--The following script enables the popover notification to appear--}}

        <script type="text/javascript">
            $('#element').popover('show');
        </script>
    @endif
@endsection
