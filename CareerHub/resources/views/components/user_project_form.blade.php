@props(['type', 'e' => null])

@if ($type === 'insert')
    <button class="w-5" onclick="document.getElementById('project_modal_insert').showModal()">
        <img src="assets/plus.png" alt="Add project">
    </button>
@else
    <button class="w-5" onclick="document.getElementById('project_modal_{{ $e->id }}').showModal()">
        <img src="assets/pencil.png" alt="Edit project">
    </button>
@endif

<dialog id="{{ $type === 'update' ? 'project_modal_' . $e->id : 'project_modal_insert' }}" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('{{ $type === 'update' ? 'project_modal_' . $e->id : 'project_modal_insert' }}').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">{{ $type === 'update' ? 'Edit Project' : 'Add Project' }}</h3>

        <form action="{{ $type === 'update' ? '/updateProject/' . $e->id : '/insertProject' }}" method="POST" class="flex flex-col justify-start items-start">
            @csrf
            <p class="py-1 font-medium text-base">Project Name</p>
            <input 
                name="project_name" 
                type="text" 
                placeholder="Input Project Name" 
                class="input input-bordered w-full max-w-lg" 
                value="{{ $type === 'update' ? $e->project_name : '' }}" 
            />

            <p class="py-1 font-medium text-base">Project Detail</p>
            <textarea 
                name="project_detail" 
                class="textarea textarea-bordered min-w-[465px]" 
                placeholder="Input Project Detail">{{ $type === 'update' ? $e->project_detail : '' }}
            </textarea>

            <button class="btn bg-primary text-white mt-4 m-auto">{{ $type === 'update' ? 'Update' : 'Save' }}</button>
        </form>
    </div>
</dialog>
