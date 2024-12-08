@extends('layouts.app')

@section('content')
<div class="container mt-7 flex gap-6">
  <div
    class="filter-section form-control bg-white w-[250px] p-5 rounded-md flex flex-col border border-input-light h-fit">
    <div class="text-lg font-bold mb-4">Filter</div>
    <div class="flex flex-col gap-2">
      <div class="flex items-center gap-2">
        <input id="company" type="checkbox" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
        <label for="company">Company</label>
      </div>
      <div class="flex items-center gap-2">
        <input id="job" type="checkbox" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
        <label for="job">Job</label>
      </div>
    </div>
  </div>
  <div class="result-section flex flex-col gap-5 bg-white p-5 flex-1 border border-input-light rounded-md">
    <div class="company-result">
      <div class="font-bold text-3xl mb-5">Companies</div>
      <div class="company-section flex flex-col">
        @foreach($companies as $company)
        <div class="flex gap-5 border-b border-input-light py-8">
          <div class="left w-[120px]">
            <img src="{{ $company->profile_picture }}" alt="Company Image">
          </div>
          <div class="right">
            {{-- TODO: redirect ke company detail page --}}
            <a href="" class="name font-semibold text-xl hover:underline">{{$company->name}}</a>
            <div class="location text-main-text">{{$company->city}},{{$company->country}}</div>
            <div class="description text-sub-text text-sm">{{$company->description}}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="job-result">
      <div class="job-section flex flex-col">
        <div class="font-bold text-3xl">Jobs</div>
        @foreach($jobs as $job)
        {{-- <div class="card flex">
          <div class="left">
            <img src="" alt="">
          </div>
          <div class="right">
            {{$company->name}}
          </div>
        </div> --}}
        <div>{{$job->job_name}}</div>
        @endforeach
      </div>
    </div>
  </div>
</div>

@endsection