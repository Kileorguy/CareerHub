@extends('layouts.app')

@section('content')
<div class="container mb-10">
  <div class="mt-5 w-full overflow-x-auto bg-white p-10 py-6 rounded-lg shadow-lg border-input-light">
    <span class="w-full pb-3 border-b flex items-center gap-4 justify-start">
      <p class="text-2xl font-bold text-left">Manage Jobs</p>
      <x-company.job_form :type="'Add'" />
    </span>
    <div class="grid grid-cols-3 gap-4 py-4 w-full">
      @if ($jobs->isNotEmpty())
      @foreach ($jobs as $job)
      <x-company.manage_job_card :job="$job" />
      @endforeach
      @else
      <div class="flex items-center justify-center w-full col-span-3">
        <p class="text-sub-text text-center">There are no jobs</p>
      </div>
      @endif
    </div>
  </div>

  <div class="mt-5 min-w-full p-10 rounded-lg shadow-lg bg-white border-input-light">
    <p class="w-full text-2xl pb-6 border-b font-bold">Manage Applications</p>
    @php
    $applications = $jobs->map->jobApplications->flatten();
    @endphp

    @if ($applications->isNotEmpty())
    <div class="py-4">
      @foreach ($applications as $jobApplication)
      <x-company.manage_job_application_card :jobApplication="$jobApplication" />
      @endforeach
    </div>
    @else
    <p class="text-sub-text w-full py-4 text-center">There are no applicants</p>
    @endif
  </div>
</div>
@endsection
<script src="./js/job-skill-input.js" defer></script>
