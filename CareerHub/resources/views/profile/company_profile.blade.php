@extends('layouts.app')

@section('content')
    <div class="hero">
        <div class="hero-content flex flex-col">
            <div class="mt-5 min-w-[1320px] bg-white p-10 rounded-lg shadow-lg flex flex-col items-start gap-2">
                <img src="{{ Auth::user()->profile_link ?? 'assets/profile-empty.png' }}"
                    class="w-36 h-36 object-cover border rounded-lg"
                >
                <p class="text-2xl font-bold">{{ $company->name }}</p>
                <p class="text-gray-500 text-lg">
                    {{ $company->description ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus amet nobis minus unde magnam, doloribus reiciendis consequatur tempore earum aspernatur illo non maxime consectetur ullam sapiente iste. Nisi, dolorem consequuntur.' }}
                </p>
                <span class="text-gray-500 flex gap-1">
                    <p>{{ $company->city }}, </p>
                    <p>{{ $company->country }}</p>
                </span>
                <span class="w-full flex gap-5 justify-end">
                    <x-company.update_profile_form :company="$company" />
                    <x-change_password_form />
                </span>
            </div>
            <div class="mt-5 w-[1320px] overflow-x-auto bg-white p-10 py-6 rounded-lg shadow-lg">
                <span class="w-full pb-3 border-b flex items-center gap-4 justify-start">
                    <p class="text-2xl font-bold text-left">Manage Jobs</p>
                    <x-company.job_form :type="'Add'" />
                </span>
                <div class="w-full flex gap-4 overflow-x-auto py-4">
                    @if ($jobs->isNotEmpty())
                        @foreach ($jobs as $job)
                            <x-company.manage_job_card :job="$job" />
                        @endforeach
                    @else
                        <p class="w-full text-center">There are no jobs</p>
                    @endif
                </div>
            </div>
            <div class="mt-5 min-w-[1320px] p-10 rounded-lg shadow-lg bg-white">
                <p class="w-full text-2xl pb-6 border-b font-bold">Manage Applications</p>
                @if ($job->jobApplications->isNotEmpty())
                    <div class="py-4">
                        @foreach ($job->jobApplications as $jobApplication)
                            <x-company.manage_job_application_card :jobApplication="$jobApplication" />
                        @endforeach
                    </div>
                @else
                    <p class="w-full py-4 text-center">There are no applicants</p>
                @endif
            </div>
        </div>
    </div>
@endsection
<script src="./js/job-skill-input.js" defer></script>
