@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="toast bg-white mr-5 mb-5 z-50 shadow show" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header flex justify-between">
    <strong class="me-auto text-black">Notification</strong>
    <!-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">X</button> -->
  </div>
  <div class="toast-body">
    {{ session('message') }}
  </div>
</div>
@endif

<div class="hero flex flex-col">
  <div class="hero-content text-center">
    <div class="mt-[20px] min-w-[1320px] bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
      <div class="flex">
        <div class="avatar">
          <div class="w-[200px] h-[200px] rounded-full">
            <img src="{{Auth::user()->profile_link ?? 'assets/profile-empty.png'}}" />
          </div>
        </div>

        <div class="pt-[10px] ml-[40px] min-w-[1000px] flex flex-col items-start">
          <p class="font-bold text-[24px] text-main-text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
          <p class="text-[#7E7E7E] text-justify text-[16px] min-h-[120px]">{{Auth::user()->short_description}} </p>
          <div class="flex items-end justify-end w-full gap-[20px] mt-[15px]">
            <x-profile_form />
            <x-change-pass_form />
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="hero-content text-center">
    <div class="mt-[20px] min-w-[1320px] bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
      <div class="flex flex-col gap-[0px] min-w-[1200px]">
        <div class="flex justify-between items-center">
          <p class="font-bold text-[18px] text-left text-main-text mb-[12newpx]">Experience</p>

          <div>
            <x-experience_form type="insert" />
          </div>
        </div>
        @isset($experiences)
        @foreach($experiences as $e)
        <div class="flex flex-col min-w-[1200px]">
          <div class="flex justify-between items-center">
            <p class="text-[18px] text-left text-main-text">{{$e->position}}</p>
            <x-experience_form type="update" :e="$e" />
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
  </div>

  <div class="hero-content text-center">
    <div class="mt-[20px] min-w-[1320px] bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
      <div class="flex flex-col gap-[0px] min-w-[1200px]">
        <div class="flex justify-between items-center">
          <p class="font-bold text-[18px] text-left text-main-text mb-[12newpx]">Education</p>

          <div>
            <x-education_form type="insert" />
          </div>
        </div>
        @isset($educations)
        @foreach($educations as $ed)
        <div class="flex flex-col min-w-[1200px]">
          <div class="flex justify-between items-center">
            <p class="text-[18px] text-left text-main-text">{{$ed->education_name}}</p>
            <x-education_form type="update" :e="$ed" />
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
  </div>

  <div class="hero-content text-center">
    <div class="mt-[20px] min-w-[1320px] bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
      <div class="flex flex-col gap-[0px] min-w-[1200px]">
        <div class="flex justify-between items-center">
          <p class="font-bold text-[18px] text-left text-main-text mb-[12newpx]">Certificate</p>

          <div>
            <x-certificate_form type="insert" />
          </div>
        </div>
        @isset($certificates)
        @foreach($certificates as $c)
        <div class="flex min-w-[1200px]">
          <img class="w-24 mr-5" src="{{$c->image_link}}" alt="">
          <div class="flex flex-col min-w-[1085px]">
            <div class="flex justify-between items-center">
              <p class="text-[18px] text-left text-main-text">{{$c->certificate_name}}</p>
              <x-certificate_form type="update" :e="$c" />
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
</div>

@endsection
