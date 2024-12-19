@props(['type', 'e' => null])

@if ($type === 'insert')
    <button class="w-5" onclick="document.getElementById('certificate_modal_insert').showModal()">
        <img src="assets/plus.png" alt="Add Certificate">
    </button>
@else
    <div class="flex gap-1">
        <button class="w-5" onclick="document.getElementById('certificate_modal_{{ $e->id }}').showModal()">
            <img src="assets/pencil.png" alt="Edit Certificate">
        </button>
        <form action="/deleteCertificate/{{$e->id}}" method="get">
            @csrf
            <button class="w-5" type="submit" >
                <img src="assets/delete.png" >
            </button>
        </form>
    </div>
@endif

<dialog id="{{ $type === 'update' ? 'certificate_modal_' . $e->id : 'certificate_modal_insert' }}" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onclick="document.getElementById('{{ $type === 'update' ? 'experience_modal_' . $e->id : 'experience_modal_insert' }}').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">{{ $type === 'update' ? 'Edit Certificate' : 'Add Certificate' }}</h3>

        <form action="{{ $type === 'update' ? '/updateCertificate/' . $e->id : '/createCertificate' }}" method="POST" class="flex flex-col justify-start items-start">
            @csrf
            <p class="py-1 font-medium text-base">Certificate Name</p>
            <input
                name="name"
                type="text"
                placeholder="Input Certificate Name"
                class="input input-bordered w-full max-w-lg"
                value="{{ $type === 'update' ? $e->certificate_name : '' }}"
            />

            <p class="py-1 font-medium text-base">Company</p>
            <input
                name="company"
                type="text"
                placeholder="Input Company"
                class="input input-bordered w-full max-w-lg"
                value="{{ $type === 'update' ? $e->company : '' }}"
            />

            <p class="py-1 font-medium text-base">Image Link</p>
            <input
                name="image"
                type="text"
                placeholder="Input Image Link"
                class="input input-bordered w-full max-w-lg"
                value="{{ $type === 'update' ? $e->image_link : '' }}"
            />

            <p class="py-1 font-medium text-base">Detail</p>
            <input
                name="detail"
                type="text"
                placeholder="Input Detail"
                class="input input-bordered w-full max-w-lg"
                value="{{ $type === 'update' ? $e->detail : '' }}"
            />

            <p class="py-1 font-medium text-base">Issued Date</p>
            <input
                name="issued_date"
                type="date"
                class="input input-bordered w-full max-w-lg"
                value="{{ $type === 'update' ? $e->issued_date : '' }}"
            />

            <button class="btn bg-primary text-white mt-4 m-auto">{{ $type === 'update' ? 'Update' : 'Save' }}</button>
        </form>
    </div>
</dialog>
