@extends('layouts.app')

@section('content')

<div class="hero flex flex-col">
  <div class="mt-[20px] w-full bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
    <div class="flex w-full">
      <div class="avatar relative group">
        <label for="profileImageInput" class="cursor-pointer">
          <div class="w-[200px] h-[200px] rounded-full overflow-hidden relative">
            @if (Auth::user()->profile_link)
            <img src="{{ Storage::url(Auth::user()->profile_link) }}" alt="Profile Picture" />
            @else
            <img src="{{ '/assets/profile-empty.png' }}" alt="Profile Picture" />
            @endif
            <div
              class="absolute inset-0 bg-black bg-opacity-50 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              Upload Profile Picture
            </div>
          </div>
        </label>
        <form method="POST" action="{{ route('updateProfilePicture') }}" enctype="multipart/form-data"
          id="profileImageForm">
          @csrf
          <input type="file" id="profileImageInput" name="profile_image" class="hidden" accept="image/*"
            onchange="document.getElementById('profileImageForm').submit();" />
        </form>
      </div>

      <div class="pt-[10px] ml-[40px] flex flex-col items-start flex-1">
        <p class="font-bold text-[24px] text-main-text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
        <p class="text-[#7E7E7E] text-justify text-[16px]">{{Auth::user()->portfolio_link}} </p>
        <p class="text-[#7E7E7E] text-justify text-[16px] min-h-[120px]">{{Auth::user()->short_description}} </p>
        <div class="flex items-end justify-end w-full gap-[20px] mt-[15px]">
          <x-user.update_profile_form />
          <x-change_password_form />
        </div>
      </div>
    </div>

  </div>

  <div class="mt-[20px] w-full bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
    <div class="flex flex-col gap-[0px] w-full">
      <div class="flex justify-between items-center">
        <p class="font-bold text-[18px] text-left text-main-text mb-[12newpx]">Experience</p>
        <div>
          <x-user.experience_form type="insert" />
        </div>
      </div>
      @isset($experiences)
      @foreach($experiences as $e)
      <div class="flex flex-col w-full">
        <div class="flex justify-between items-center">
          <p class="text-[18px] text-left text-main-text">{{$e->position}}</p>
          <x-user.experience_form type="update" :e="$e" />
        </div>
        <p class="text-[18px] text-left text-sub-text">{{$e->company}}</p>
        <p class="text-[18px] text-left text-sub-text">
          {{ \Carbon\Carbon::parse($e->start_date)->format('F j, Y') }} - {{
          \Carbon\Carbon::parse($e->end_date)->format('F j, Y') }}
        </p>
        <p class="text-[14px] text-left text-sub-text">{{$e->description}}</p>
        <hr class="h-px mt-[10px] mb-[10px] bg-gray-200 border-0 dark:bg-gray-700">
      </div>
      @endforeach
      @endisset
    </div>
  </div>

  <div class="mt-[20px] w-full bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
    <div class="flex flex-col gap-[0px] w-full">
      <div class="flex justify-between items-center">
        <p class="font-bold text-[18px] text-left text-main-text mb-[12newpx]">Education</p>
        <div>
          <x-user.education_form type="insert" />
        </div>
      </div>
      @isset($educations)
      @foreach($educations as $ed)
      <div class="flex flex-col w-full">
        <div class="flex justify-between items-center">
          <p class="text-[18px] text-left text-main-text">{{$ed->education_name}}</p>
          <x-user.education_form type="update" :e="$ed" />
        </div>
        <p class="text-[18px] text-left text-sub-text">{{$ed->major}}</p>
        <p class="text-[18px] text-left text-sub-text">
          {{ \Carbon\Carbon::parse($ed->start_date)->format('F j, Y') }} - {{
          \Carbon\Carbon::parse($ed->end_date)->format('F j, Y') }}
        </p>
        <p class="text-[14px] text-left text-sub-text font-semibold">Grade : {{$ed->gpa}}</p>
        <hr class="h-px mt-[10px] mb-[10px] bg-gray-200 border-0 dark:bg-gray-700">
      </div>
      @endforeach
      @endisset
    </div>
  </div>

  <div class="mt-[20px] w-full bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
    <div class="flex flex-col gap-[0px] w-full">
      <div class="flex justify-between items-center">
        <p class="font-bold text-[18px] text-left text-main-text mb-[12newpx]">Skill</p>
        <div>
          <x-user.skill_form type="insert" :jobSkills="$jobSkills" />
        </div>
      </div>
      @isset($skills)
      @foreach($skills as $e)
      <div class="flex flex-col w-full">
        <div class="flex justify-between items-center">
          <p class="text-[18px] text-left text-main-text">{{$e->skill_name}}</p>
          <x-user.skill_form type="update" :e="$e" :jobSkills="$jobSkills" />
        </div>
        <hr class="h-px mt-[10px] mb-[10px] bg-gray-200 border-0 dark:bg-gray-700">
      </div>
      @endforeach
      @endisset
    </div>
  </div>

  <div class="mt-[20px] w-full bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
    <div class="flex flex-col gap-[0px] w-full">
      <div class="flex justify-between items-center">
        <p class="font-bold text-[18px] text-left text-main-text mb-[12newpx]">Project</p>
        <div>
          <x-user.project_form type="insert" />
        </div>
      </div>
      @isset($projects)
      @foreach($projects as $e)
      <div class="flex flex-col w-full">
        <div class="flex justify-between items-center">
          <p class="text-[18px] text-left text-main-text">{{$e->project_name}}</p>
          <x-user.project_form type="update" :e="$e" />
        </div>
        <p class="text-[14px] text-left text-sub-text">{{$e->project_detail}}</p>
        <hr class="h-px mt-[10px] mb-[10px] bg-gray-200 border-0 dark:bg-gray-700">
      </div>
      @endforeach
      @endisset
    </div>
  </div>

  <div class="mt-[20px] w-full bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
    <div class="flex flex-col gap-[0px] w-full">
      <div class="flex justify-between items-center">
        <p class="font-bold text-[18px] text-left text-main-text mb-[12newpx]">Certificate</p>
        <div>
          <x-user.certificate_form type="insert" />
        </div>
      </div>
      @isset($certificates)
      @foreach($certificates as $c)
      <div class="flex w-full">
        <div class="flex flex-col min-w-[1085px]">
          <div class="flex justify-between items-center">
            <p class="text-[18px] text-left text-main-text">{{$c->certificate_name}}</p>
            <x-user.certificate_form type="update" :e="$c" />
          </div>
          <p class="text-[18px] text-left text-sub-text">{{$c->company}}</p>
          <p class="text-[18px] text-left text-sub-text">
            Issued {{ \Carbon\Carbon::parse($c->issued_date)->format('F j, Y') }}
          </p>
          <p class="text-[14px] text-left text-sub-text font-semibold">{{$c->detail}}</p>
        </div>
      </div>
      <hr class="h-px mt-[10px] mb-[10px] bg-gray-200 border-0 dark:bg-gray-700">
      @endforeach
      @endisset
    </div>
  </div>
</div>

@endsection