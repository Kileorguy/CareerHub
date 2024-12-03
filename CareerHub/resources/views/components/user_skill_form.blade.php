@props(['type', 'e' => null])

@if ($type === 'insert')
    <button class="w-5" onclick="document.getElementById('skill_modal_insert').showModal()">
        <img src="assets/plus.png" alt="Add skill">
    </button>
@else
    <button class="w-5" onclick="document.getElementById('skill_modal_{{ $e->id }}').showModal()">
        <img src="assets/pencil.png" alt="Edit skill">
    </button>
@endif

<dialog id="{{ $type === 'update' ? 'skill_modal_' . $e->id : 'skill_modal_insert' }}" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('{{ $type === 'update' ? 'project_modal_' . $e->id : 'project_modal_insert' }}').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">{{ $type === 'update' ? 'Edit Skill' : 'Add Skill' }}</h3>

        <form action="{{ $type === 'update' ? '/updateSkill/' . $e->id : '/insertSkill' }}" method="POST" class="flex flex-col justify-start items-start">
            @csrf
            <p class="py-1 font-medium text-base">Skill Name</p>
            <input 
                name="skill_name" 
                type="text" 
                placeholder="Input Skill Name" 
                class="input input-bordered w-full max-w-lg" 
                value="{{ $type === 'update' ? $e->skill_name : '' }}" 
            />

            <button class="btn bg-primary text-white mt-4 m-auto">{{ $type === 'update' ? 'Update' : 'Save' }}</button>
        </form>
    </div>
</dialog>
