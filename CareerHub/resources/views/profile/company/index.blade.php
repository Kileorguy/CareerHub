@extends('layouts.app')

@section('content')
    <div class="hero">
        <div class="hero-content">
            <div class="mt-[20px] min-w-[1320px] bg-white p-10 rounded-lg shadow-lg flex flex-col items-start gap-2">
                <img class="w-36 h-36" src="assets/profile-empty.png" alt="">
                <p class="text-2xl font-bold">{{$company->name}}</p>
                <p class="text-gray-500 text-lg">{{ $company->description ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus amet nobis minus unde magnam, doloribus reiciendis consequatur tempore earum aspernatur illo non maxime consectetur ullam sapiente iste. Nisi, dolorem consequuntur.' }}</p>
                <span class="text-gray-500 flex gap-1">
                    <p>{{ $company->city }}, </p>
                    <p>{{ $company->country }}</p>
                </span>
                <span class="w-full flex justify-end">
                    
                </span>
            </div>
        </div>
    </div>
@endsection
