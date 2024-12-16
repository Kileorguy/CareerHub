@extends('layouts.app')

@section('content')
<div class="container">
  <div class="flex flex-col">
    <div class="mt-5 w-full bg-white p-10 rounded-lg shadow-lg flex flex-col items-start gap-2">
      <img src="{{ Auth::user()->profile_link ?? 'assets/profile-empty.png' }}"
        class="w-36 h-36 object-cover border rounded-lg">
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