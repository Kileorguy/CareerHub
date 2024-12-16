@extends('layouts.app')

@section('content')
<div class="container mt-7 mb-10 flex flex-col gap-3 shadow-lg">
  <div class="proflie-container flex bg-white p-8 rounded-md border border-input-light gap-5">
    <div class="left">
      <img src="{{$employee->profile_link ?? '/assets/profile-empty.png'}}" alt="Company picture" class="w-[250px]">
    </div>
    <div class="right">
      <div class="text-primary name font-semibold text-2xl hover:underline">
        {{$employee->first_name}} {{$employee->last_name}}</div>
      <div class="location text-main-text">{{$employee->github_link ?? 'No github link'}}</div>
      <p class="description text-sub-text text-sm">{{$employee->short_description ?? 'No description'}}</p>
    </div>
  </div>
</div>
@endsection