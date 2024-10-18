@php use Illuminate\Support\Facades\Auth; @endphp
<x-layout>
    <div class="hero bg-background min-h-screen flex flex-col">
        <div class="hero-content text-center">
            <div class="bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
                <p class="font-bold text-main-text text-xl">Jobs For You</p>
                <p class="text-sub-text mb-8">Based on your skills and experience</p>

                @foreach($companies as $company)
                    <x-jobs_card
                        position="{{ $company->position_name }}"
                        location="{{ $company->city }}, {{ $company->country }}"
                        company="{{ $company->company_name }}"
                        logo="{{ $company->profile_picture }}"
                    />
                @endforeach

            </div>
        </div>
    </div>
</x-layout>
