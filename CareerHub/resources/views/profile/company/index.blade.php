@extends('layouts.app')

@section('content')
<div class="container">
  <div>{{$company->company_name}}</div>
  <div>{{$company->location}}</div>
</div>
@endsection