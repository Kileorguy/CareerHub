@extends('layouts.app')

@section('content')
<div class="container mt-7 mb-10 flex flex-col gap-3">
  <div class="proflie-container flex bg-white p-8 rounded-md border border-input-light gap-5 shadow-lg">
    <div class="left w-[250px]">
      @if ($company->user->profile_link)
      <img
        src="{{ (strpos($company->user->profile_link, 'profile_images') !== false) ?  Storage::url($company->user->profile_link) : $company->user->profile_link }}"
        alt="Company Image">
      @else
      <img src='/assets/profile-empty.png' alt="Company Image">
      @endif
    </div>
    <div class="right">
      <div class="text-primary name font-semibold text-2xl">{{$company->name}}</div>
      <div class="location text-main-text">{{$company->city}},{{$company->country}}</div>
      <p class="description text-sub-text text-sm">{{$company->description}}</p>
    </div>
  </div>

  <div class="job-container rounded-md border border-input-light bg-white px-8 py-6 shadow-lg">
    <div class="text-xl font-semibold text-main-text mb-4">Recently posted jobs</div>
    <div class="content grid grid-cols-3 gap-10">
      @if ($jobs->isNotEmpty())
      @foreach ($jobs as $job)
      <div class="border border-input-light rounded-lg p-5">
        <div class="w-1/3 mb-2">
          @if ($company->user->profile_link)
          <img
            src="{{ (strpos($company->user->profile_link, 'profile_images') !== false) ?  Storage::url($company->user->profile_link) : $company->user->profile_link }}"
            alt="Company Image">
          @else
          <img src='/assets/profile-empty.png' alt="Company Image">
          @endif
        </div>
        <a href="{{route('jobDetail', $job->id)}}"
          class="text-primary name font-semibold text-xl hover:underline">{{$job->job_name}}</a>
        <div class="badge badge-outline badge-sm">{{$job->job_level}}</div>
        <p class="description text-sub-text text-sm mt-2">{{ Str::limit($job->job_description, 200, '...') }}</p>
      </div>
      @endforeach
      @else
      <div class="text-sub-text">
        No job posted
      </div>
      @endif
    </div>
    <div class="mt-4">
      {{$jobs->links('vendor.pagination.tailwind')}}
    </div>
  </div>
</div>
@endsection