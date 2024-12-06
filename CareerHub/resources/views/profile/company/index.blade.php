@extends('layouts.app')

@section('content')
    <div class="hero">
        <div class="hero-content flex flex-col">
            <div class="mt-5 min-w-[1320px] bg-white p-10 rounded-lg shadow-lg flex flex-col items-start gap-2">
                <img class="w-36 h-36" src="{{ Auth::user()->profile_link ?? 'assets/profile-empty.png' }}" alt="">
                <p class="text-2xl font-bold">{{ $company->name }}</p>
                <p class="text-gray-500 text-lg">
                    {{ $company->description ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus amet nobis minus unde magnam, doloribus reiciendis consequatur tempore earum aspernatur illo non maxime consectetur ullam sapiente iste. Nisi, dolorem consequuntur.' }}
                </p>
                <span class="text-gray-500 flex gap-1">
                    <p>{{ $company->city }}, </p>
                    <p>{{ $company->country }}</p>
                </span>
                <span class="w-full flex gap-5 justify-end">
                    <x-edit_company_profile_form :company="$company" />
                    <x-change-pass_form />
                </span>
            </div>
            <div class="mt-5 min-w-[1320px] bg-white p-10 rounded-lg shadow-lg">
                <span class="flex items-center gap-4">
                    <p class="text-2xl font-bold">Manage Jobs</p>
                    <x-add_job_form :company="$company" />
                </span>
                <div class="w-full flex gap-4 overflow-x-auto py-4">
                    @if ($jobs->isNotEmpty())
                        @foreach ($jobs as $job)
                            <div class="w-72 h-96 p-4 shadow-lg rounded-lg relative">
                                <p class="text-lg font-bold">{{ $job->job_name }}</p>
                                <p class="mt-2 text-sm font-semibold text-gray-500">
                                    Job description
                                </p>
                                <p>{{ $job->job_description }}</p>

                                <p class="mt-2 text-sm font-semibold text-gray-500">
                                    Job level
                                </p>
                                <p>{{ $job->job_level }}</p>

                                <p class="mt-2 text-sm font-semibold text-gray-500">
                                    Job Skills
                                </p>
                                <ul class="grid grid-cols-2 list-disc list-inside">
                                    @foreach ($job->jobSkills as $skill)
                                        <li> {{ $skill->skill_name }}</li>
                                    @endforeach
                                </ul>
                                <span class="absolute w-full flex justify-evenly bottom-4">
                                    <x-delete_job_form :job="$job" />
                                    <x-edit_job_form :job="$job" />
                                </span>
                            </div>
                        @endforeach
                    @else
                        <p class="w-full text-center">There are no jobs</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
