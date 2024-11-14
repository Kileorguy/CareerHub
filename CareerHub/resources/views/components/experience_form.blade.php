@props(['type', 'e'])

@if ($type=='insert')
    <button class="w-5" onclick="my_modal_3.showModal()"><img src="assets/plus.png" alt=""></button>
@else
    <button class="w-5" onclick="my_modal_3.showModal()"><img src="assets/pencil.png" alt=""></button>
@endif

<dialog id="my_modal_3" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">Experience</h3>
        
        <form action="{{ $type === 'update' ? '/updateExperience/' . $e->id : '/insertExperience' }}" method="POST" class="flex flex-col justify-start items-start">
            @csrf
            <p class="py-1 font-medium text-base">Job</p>
            <input 
                name="job" 
                type="text" 
                placeholder="Input Job" 
                class="input input-bordered w-full max-w-lg" 
                value="{{ $type === 'update' ? $e->position : '' }}" 
            />

            <p class="py-1 font-medium text-base">Company</p>
            <input 
                name="company" 
                type="text" 
                placeholder="Input Company" 
                class="input input-bordered w-full max-w-lg" 
                value="{{ $type === 'update' ? $e->company : '' }}" 
            />

            <p class="py-1 font-medium text-base">Short Description</p>
            <textarea 
                name="description" 
                class="textarea textarea-bordered min-w-[465px]" 
                placeholder="Input Short Description">{{ $type === 'update' ? $e->description : '' }}</textarea>

            <p class="py-1 font-medium text-base">Start Date</p>
            <input 
                name="start_date" 
                type="date" 
                class="input input-bordered w-full max-w-lg" 
                value="{{ $type === 'update' ? $e->start_date : '' }}" 
            />

            <p class="py-1 font-medium text-base">End Date</p>
            <input 
                name="end_date" 
                type="date" 
                class="input input-bordered w-full max-w-lg" 
                value="{{ $type === 'update' ? $e->end_date : '' }}" 
            />

            <button class="btn bg-primary text-white mt-4 m-auto">{{ $type === 'update' ? 'Update' : 'Save' }}</button>
        </form>
    </div>
</dialog>
