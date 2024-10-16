<x-layout>
    <div class="hero bg-background min-h-screen flex flex-col">
        <div class="hero-content text-center">
            <div class="mt-[20px] bg-white p-10 rounded-lg shadow-lg flex flex-col items-start">
                <div class="flex">
                    <div class="avatar">
                        <div class="w-[200px] h-[200px] rounded-full">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                        </div>
                    </div>

                    <div class="pt-[10px] ml-[40px] min-w-[1000px] flex flex-col items-start">
                        <p class="font-bold text-[24px] text-[#505050]">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                        <p class="text-[#7E7E7E] text-justify text-[16px] min-h-[120px]">{{Auth::user()->short_description}} </p>
                        <div class="flex items-end justify-end w-full gap-[20px] mt-[15px]">
                            <button class="btn w-[180px] min-h-0 h-[40px] p-0 m-0 bg-primary text-background">Edit</button>
                            <button class="btn w-[180px] min-h-0 h-[40px] p-0 m-0 bg-primary text-background">Change Password</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
