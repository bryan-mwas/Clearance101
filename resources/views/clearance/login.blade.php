@extends('welcome')

@section('content')
    <form method="post" action="login.blade.php">
        {!! csrf_field() !!}
        <label for="user">User ID</label>
        <input name="user" type="text" placeholder="Enter UserID"><br>
        <label for="pass">Password</label>
        <input name="pass" type="password" placeholder="Enter your password">
        <input type="submit" value="Login">
    </form>
@endsection