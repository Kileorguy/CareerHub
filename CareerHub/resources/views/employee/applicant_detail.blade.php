@extends('layouts.app')

@section('content')
<div class="container mt-7 mb-10 flex flex-col gap-3 shadow-lg">
  <div class="proflie-container flex bg-white p-8 rounded-md border border-input-light gap-5">
    <div class="left">
      <img src="{{$employee->profile_link ?? '/assets/profile-empty.png'}}" alt="Company picture" class="w-[200px]">
    </div>
    <div class="right flex-1">
      <div class="text-primary name font-semibold text-2xl">
        {{$employee->first_name}} {{$employee->last_name}}</div>
      <div class="location text-main-text">{{$employee->github_link ?? 'No github link'}}</div>
      <p class="description text-sub-text text-sm">{{$employee->short_description ?? 'No description'}}</p>
      <div class="mt-2 font-semibold text-lg">Skills</div>
      <div class="skill-container flex flex-wrap gap-3 mt-2">
        @foreach ($employee->skills as $skill)
        <div class="border border-primary rounded-full p-3 text-xs text-primary">{{$skill->skill_name}}</div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="experience-container bg-white p-8 rounded-md border border-input-light">
    <div class="text-xl font-semibold text-main-text mb-4">Experiences</div>
    <div class="content grid grid-cols-3">
      @foreach ($employee->experiences as $experience)
      <div class="border border-input-light rounded-lg p-5 h-[200px] overflow-y-auto">
        <div class="text-primary text-lg font-semibold">{{$experience->company}}</div>
        <div class="text-main-text">{{$experience->position}}</div>
        <div class="text-sub-text text-xs">{{$experience->start_date}} to {{$experience->end_date}}</div>
        <div class="description text-main-text mt-2 text-sm">{{$experience->description}}</div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="certificate-container bg-white p-8 rounded-md border border-input-light">
    <div class="text-xl font-semibold text-main-text mb-4">Certificates</div>
    <div class="content grid grid-cols-3">
      @foreach ($employee->certificates as $certificate)
      <div class="border border-input-light rounded-lg p-5 h-[200px] overflow-y-auto">
        <div class="text-primary text-lg font-semibold">{{$certificate->certificate_name}}</div>
        <div class="text-main-text">{{$certificate->company}}</div>
        <div class="text-sub-text text-xs">{{$certificate->issued_date}}</div>
        <div class="description text-main-text mt-2 text-sm">{{$certificate->detail}}</div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="project-container bg-white p-8 rounded-md border border-input-light">
    <div class="text-xl font-semibold text-main-text mb-4">Projects</div>
    <div class="content grid grid-cols-3">
      @foreach ($employee->projects as $project)
      <div class="border border-input-light rounded-lg p-5 h-[200px] overflow-y-auto">
        <div class="text-primary text-lg font-semibold">{{$project->project_name}}</div>
        <div class="description text-main-text mt-2 text-sm">{{$project->project_detail}}</div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="education-container bg-white p-8 rounded-md border border-input-light">
    <div class="text-xl font-semibold text-main-text mb-4">Educations</div>
    <div class="content grid grid-cols-3">
      @foreach ($employee->educations as $education)
      <div class="border border-input-light rounded-lg p-5">
        <div class="text-primary text-lg font-semibold">{{$education->education_name}}</div>
        <div class="text-main-text">{{$education->major}}, GPA: {{$education->gpa}}</div>
        <div class="text-sub-text text-xs">{{$education->start_date}} to {{$education->end_date}}</div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection