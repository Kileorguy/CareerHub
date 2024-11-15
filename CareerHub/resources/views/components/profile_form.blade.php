<button class="btn w-[180px] min-h-0 h-[40px] p-0 m-0 bg-primary text-background" onclick="document.getElementById('update_user').showModal()">Edit</button>

<dialog id="update_user" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('experience_modal_insert').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">Update Profile</h3>

        <form action="/updateProfile" method="POST" class="flex flex-col justify-start items-start">
            @csrf
            <p class="py-1 font-medium text-base">First Name</p>
            <input 
                name="first" 
                type="text" 
                placeholder="Input First Name" 
                class="input input-bordered w-full max-w-lg" 
                value="{{Auth::user()->first_name}}" 
            />

            <p class="py-1 font-medium text-base">Last Name</p>
            <input 
                name="lastName" 
                type="text" 
                placeholder="Input Last Name" 
                class="input input-bordered w-full max-w-lg" 
                value="{{Auth::user()->last_name}}" 
            />

            <p class="py-1 font-medium text-base">Short Description</p>
            <input 
                name="desc" 
                type="text" 
                placeholder="Input Short Description" 
                class="input input-bordered w-full max-w-lg" 
                value="{{Auth::user()->short_description}}" 
            />

            <p class="py-1 font-medium text-base">Portofolio Link</p>
            <input 
                name="porto" 
                type="text" 
                placeholder="Input Portofolio Link" 
                class="input input-bordered w-full max-w-lg" 
                value="{{ Auth::user()->portfolio_link }}" 
            />

            <p class="py-1 font-medium text-base">Github Link</p>
            <input 
                name="github"
                type="text" 
                placeholder="Input Github Link" 
                class="input input-bordered w-full max-w-lg" 
                value="{{ Auth::user()->github_link }}" 
            />

            <p class="py-1 font-medium text-base">Profile Image Link</p>
            <input 
                name="profile_image"
                type="text" 
                placeholder="Input Profile Image Link" 
                class="input input-bordered w-full max-w-lg" 
                value="{{ Auth::user()->profile_link }}" 
            />

            <button class="btn bg-primary text-white mt-4 m-auto">Update</button>
        </form>
    </div>
</dialog>
