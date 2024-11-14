<x-layout>
    <div class="hero bg-background min-h-screen flex flex-col">
        <div class="hero-content text-center">
            <div class="mt-[20px] min-w-[1320px] bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
                <div class="flex">
                    <div class="avatar">
                        <div class="w-[200px] h-[200px] rounded-full">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                        </div>
                    </div>

                    <div class="pt-[10px] ml-[40px] min-w-[1000px] flex flex-col items-start">
                        <p class="font-bold text-[24px] text-main-text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                        <p class="text-[#7E7E7E] text-justify text-[16px] min-h-[120px]">{{Auth::user()->short_description}} </p>
                        <div class="flex items-end justify-end w-full gap-[20px] mt-[15px]">
                            <button class="btn w-[180px] min-h-0 h-[40px] p-0 m-0 bg-primary text-background">Edit</button>
                            <button class="btn w-[180px] min-h-0 h-[40px] p-0 m-0 bg-primary text-background">Change Password</button>
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
                                <x-experience_form type="insert" :e="null"/>
                            </div>
                        </div>
                        @isset($experiences)
                        @foreach($experiences as $e)
                            <div class="flex flex-col min-w-[1200px]">
                                <div class="flex justify-between items-center">
                                    <p class="text-[18px] text-left text-main-text">{{$e->position}}</p>

                                    <button class="w-5" onclick="document.getElementById('modal_{{ $e->id }}').showModal()">
                                        <img src="assets/pencil.png" alt="">
                                    </button>
                                </div>

                                <p class="text-[18px] text-left text-sub-text">{{$e->company}}</p>
                                <p class="text-[18px] text-left text-sub-text">
                                    {{ \Carbon\Carbon::parse($e->start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($e->end_date)->format('F j, Y') }}
                                </p>
                                <p class="text-[14px] text-left text-sub-text">{{$e->description}}</p>
                                <hr class="h-px mt-[10px] mb-[10px] bg-gray-200 border-0 dark:bg-gray-700">

                                <dialog id="modal_{{ $e->id }}" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('modal_{{ $e->id }}').close()">✕</button>
                                        </form>
                                        <h3 class="text-xl font-bold pb-4">Edit Experience</h3>

                                        <form action="/updateExperience/{{ $e->id }}" method="POST" class="flex flex-col justify-start items-start">
                                            @csrf
                                            <p class="py-1 font-medium text-base">Job</p>
                                            <input name="job" type="text" placeholder="Input Job" class="input input-bordered w-full max-w-lg" value="{{ $e->position }}" />

                                            <p class="py-1 font-medium text-base">Company</p>
                                            <input name="company" type="text" placeholder="Input Company" class="input input-bordered w-full max-w-lg" value="{{ $e->company }}" />

                                            <p class="py-1 font-medium text-base">Short Description</p>
                                            <textarea name="description" class="textarea textarea-bordered min-w-[465px]" placeholder="Input Short Description">{{ $e->description }}</textarea>

                                            <p class="py-1 font-medium text-base">Start Date</p>
                                            <input name="start_date" type="date" class="input input-bordered w-full max-w-lg" value="{{ $e->start_date }}" />

                                            <p class="py-1 font-medium text-base">End Date</p>
                                            <input name="end_date" type="date" class="input input-bordered w-full max-w-lg" value="{{ $e->end_date }}" />

                                            <button class="btn bg-primary text-white mt-4 m-auto">Update</button>
                                        </form>
                                    </div>
                                </dialog>
                            </div>
                        @endforeach
                        @endisset
                </div>
            </div>
        </div>
    </div>
</x-layout>
