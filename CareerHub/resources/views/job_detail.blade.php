@php use Illuminate\Support\Facades\Auth; @endphp

@extends('layouts.app')

@section('content')
@if ($job == null)
<div class="flex flex-col h-screen items-center justify-center gap-4">
  <p class="text-2xl font-bold text-primary">Job Not Found</p>
</div>
@else
<div class="flex gap-6 m-4 p-6 rounded-lg shadow-lg bg-white w-full">
  <a class="w-[400px]" href="{{route('companyDetail', $job->company)}}">
    <img src="{{ $job->company->user->profile_link ?? '/assets/profile-empty.png' }}"
      class="w-full border rounded-lg object-cover">
  </a>
  <div class="flex flex-col gap-4 w-full">
    <div>
      <p class="text-primary font-bold text-2xl">{{ $job->job_name }}</p>
      <a href="{{route('companyDetail', $job->company)}}">
        <p class="text-black font-bold text-lg hover:underline"> {{ $job->company->name }} </p>
      </a>
      <p class="text-gray-500 font-bold text-base"> {{ $job->company->city }}, {{ $job->company->country }}
      </p>
    </div>
    <div>
      <p class="text-black font-bold text-base">Job Level:</p>
      <p class="text-gray-500 text-sm">{{ $job->job_level }}</p>
    </div>
    <div>
      <p class="text-black font-bold text-base">Job Description:</p>
      <p class="text-gray-500 text-sm">{{ $job->job_description }}</p>
    </div>
    <div>
      <p class="text-black font-bold text-base">Job Skills:</p>
      <ul class="flex flex-wrap list-disc list-inside gap-x-4">
        @foreach ($job->job_skills as $skill)
        <li>{{ $skill->skill_name }}</li>
        @endforeach
      </ul>
    </div>
    <div class="flex justify-end w-full">
      @if (Auth::user()->role == 'Employee')
      @if ($jobApplication == null)
      <form action="{{ route('applyJob', ['id' => $job->id]) }}" method="POST">
        @csrf
        <button class="btn btn-primary text-white w-40">Apply Job</button>
      </form>
      @elseif ($jobApplication->status == 'Pending')
      <p class="text-gray-500 bg-gray-200 text-center py-2 rounded-lg shadow-lg w-28">Pending</p>
      @elseif ($jobApplication->status == 'Accepted')
      <p class="text-green-500 bg-green-200 text-center py-2 rounded-lg shadow-lg w-28">Accepted</p>
      @elseif ($jobApplication->status == 'Rejected')
      <p class="text-red-500 bg-red-200 text-center py-2 rounded-lg shadow-lg w-28">Rejected</p>
      @endif
      @endif
    </div>
  </div>

</div>
@endif

@endsection