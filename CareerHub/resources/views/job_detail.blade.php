@php use Illuminate\Support\Facades\Auth; @endphp

@extends('layouts.app')

@section('content')
    <div class="flex gap-6 m-4 p-6 rounded-lg shadow-lg bg-white ">
        <img src="{{ $job->company->user->profile_link ?? '/assets/profile-empty.png' }}"
            class="w-64 h-64 border rounded-lg object-cover">

        <div class="flex flex-col gap-4">
            <div>
                <p class="text-primary font-bold text-2xl">{{ $job->job_name }}</p>
                <p class="text-black font-bold text-lg"> {{ $job->company->name }} </p>
                <p class="text-gray-500 font-bold text-base"> {{ $job->company->city }}, {{ $job->company->country }} </p>
            </div>
            <div>
                <p class="text-black font-bold text-base">Job Description:</p>
                <p class="text-gray-500 text-sm">{{ $job->job_description }}</p>
            </div>
            <div>
                <p class="text-black font-bold text-base">Job Level:</p>
                <p class="text-gray-500 text-sm">{{ $job->job_level }}</p>
            </div>
            <div>
                <p class="text-black font-bold text-base">Job Skills:</p>
                <ul class="flex flex-wrap list-disc list-inside gap-x-4">
                    @foreach ($job->job_skills as $skill)
                        <li>{{ $skill->skill_name }}</li>
                    @endforeach
                </ul>
            </div>
            @if (Auth::user()->role == 'Employee')
                <a href="{{ route('applyJob', ['id' => $job->id]) }}">
                    <button class="btn btn-primary text-white w-40">Apply Job</button>
                </a>
            @endif
        </div>

    </div>
@endsection
