@extends('layouts.app')

@section('content')
<div class="container mt-7 flex flex-col gap-5 w-full mb-10">
  <div class="header">
    <p class="text-xl text-main-text font-bold">More job results of "{{request('query')}}"</p>
    <p class="text-sub-text">About {{$jobs->total()}} results</p>
  </div>
  <div class="result bg-white p-5 flex-1 border border-input-light rounded-md shadow-lg">
    <div class="company-section flex flex-col">
      @foreach($jobs as $job)
      <div class="flex gap-5 {{ $loop->last ? 'pt-8 pb-4' : 'border-b py-8  ' }} border-input-light py-8">
        <div class="left w-[120px] flex-shrink-0">
          <img src="{{$job->company->user->profile_link ?? 'assets/profile-empty.png'}}" alt="Company Image">
        </div>
        <div class="right">
          <div class="flex gap-3 items-center">
            <a href="{{route('jobDetail', $job->id)}}"
              class="text-primary name font-semibold text-xl hover:underline">{{$job->job_name}}</a>
            <div class="badge badge-outline">{{$job->job_level}}</div>
          </div>
          <div class="location text-main-text">{{$job->company->city}},{{$job->company->country}}</div>
          <p class="description text-sub-text text-sm">{{ Str::limit($job->job_description, 200, '...') }}</p>
        </div>
      </div>
      @endforeach
    </div>
    <div>
      {{$jobs->links('vendor.pagination.tailwind')}}
    </div>
  </div>

  @endsection