<button class="btn w-[180px] min-h-0 h-[40px] p-0 m-0 bg-primary text-background" onclick="document.getElementById('change_pass').showModal()">Change Password</button>

<dialog id="change_pass" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('experience_modal_insert').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">Change Password</h3>

        <form action="/changePassword" method="POST" class="flex flex-col justify-start items-start">
            @csrf
            <p class="py-1 font-medium text-base">Old Password</p>
            <input 
                name="old" 
                type="text" 
                placeholder="Input Old Password" 
                class="input input-bordered w-full max-w-lg" 
            />

            <p class="py-1 font-medium text-base">New Password</p>
            <input 
                name="new" 
                type="text" 
                placeholder="Input New Password" 
                class="input input-bordered w-full max-w-lg" 
            />

            <p class="py-1 font-medium text-base">Confirm New Password</p>
            <input 
                name="confirm" 
                type="text" 
                placeholder="Input Confirm New Password" 
                class="input input-bordered w-full max-w-lg" 
            />

            <button class="btn bg-primary text-white mt-4 m-auto">Update</button>
        </form>
    </div>
</dialog>
