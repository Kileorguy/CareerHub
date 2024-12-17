@props(['type', 'e' => null])

@if ($type === 'insert')
    <button class="w-5" onclick="document.getElementById('education_modal_insert').showModal()">
        <img src="assets/plus.png" alt="Add Education">
    </button>
@else
    <button class="w-5" onclick="document.getElementById('education_modal_{{ $e->id }}').showModal()">
        <img src="assets/pencil.png" alt="Edit Education">
    </button>
@endif

<dialog id="{{ $type === 'update' ? 'education_modal_' . $e->id : 'education_modal_insert' }}" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('{{ $type === 'update' ? 'experience_modal_' . $e->id : 'experience_modal_insert' }}').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">{{ $type === 'update' ? 'Edit Education' : 'Add Education' }}</h3>

        <form action="{{ $type === 'update' ? '/updateEducation/' . $e->id : '/createEducation' }}" method="POST" class="flex flex-col justify-start items-start">
            @csrf
            <p class="py-1 font-medium text-base">Major</p>
            <input
                name="major"
                type="text"
                placeholder="Input Major"
                class="input input-bordered w-full max-w-lg"
                value="{{ $type === 'update' ? $e->major : '' }}"
            />

            <p class="py-1 font-medium text-base">School</p>
            <input
                name="school"
                type="text"
                placeholder="Input School"
                class="input input-bordered w-full max-w-lg"
                value="{{ $type === 'update' ? $e->education_name : '' }}"
            />

            <p class="py-1 font-medium text-base">Grade</p>
                <input
                name="grade"
                type="number"
                max="100"
                min="0"
                placeholder="Input Grade"
                class="input input-bordered w-full max-w-lg"
                value="{{ $type === 'update' ? $e->gpa : '' }}"
            />

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
