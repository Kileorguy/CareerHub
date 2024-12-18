@extends('layouts.app')

@section('content')
<div class="container mt-7 flex flex-col gap-5 w-full mb-10">
  <div class="header">
    <p class="text-xl text-main-text font-bold">More company results of "{{request('query')}}"</p>
    <p class="text-sub-text">About {{$companies->total()}} results</p>
  </div>
  <div class="result bg-white p-5 flex-1 border border-input-light rounded-md shadow-lg">
    <div class="company-section flex flex-col">
      @foreach($companies as $company)
      <div class="flex gap-5 {{ $loop->last ? 'pt-8 pb-4' : 'border-b py-8' }} border-input-light">
        <div class="left w-[120px] flex-shrink-0">
          <img src="{{$company->user->profile_link ?? '/assets/profile-empty.png'}}" alt="Company Image">
        </div>
        <div class="right">
          <a href="" class="text-primary name font-semibold text-xl hover:underline">{{$company->name}}</a>
          <div class="location text-main-text">{{$company->city}},{{$company->country}}</div>
          <p class="description text-sub-text text-sm">{{Str::limit($company->description, 200, '...')}}</p>
        </div>
      </div>
      @endforeach
    </div>
    <div>
      {{$companies->links('vendor.pagination.tailwind')}}
    </div>
  </div>

  @endsection