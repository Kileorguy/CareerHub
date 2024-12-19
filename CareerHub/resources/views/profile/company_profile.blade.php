@extends('layouts.app')

@section('content')
<div class="container">
  <div class="flex flex-col">
    <div class="mt-5 w-full bg-white p-10 rounded-lg shadow-lg flex flex-col items-start gap-2">
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
      <p class="text-2xl font-bold">{{ $company->name }}</p>
      <p class="text-gray-500 text-lg">
        {{ $company->description ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus amet nobis
        minus unde magnam, doloribus reiciendis consequatur tempore earum aspernatur illo non maxime consectetur ullam
        sapiente iste. Nisi, dolorem consequuntur.' }}
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
  </div>
</div>
@endsection
<script src="./js/job-skill-input.js" defer></script>