@extends('layouts.superuser')
@section('title','Admin Page')
@section('content')
<div class="">
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
@endsection
