<button class="btn w-[180px] min-h-0 h-[40px] p-0 m-0 bg-primary text-background"
    onclick="document.getElementById('update-company').showModal()">Edit</button>

<dialog id="update-company" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                onclick="document.getElementById('update-company').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">Update Company</h3>

        <form class="flex flex-col justify-start items-start"
            action="/updateCompanyProfile"
            method="POST"
        >
            @csrf
            <input type="hidden"
                name="id"
                id="id"
                value="{{ $company->id }}"
            >
            <label for="name"
                class="py-1 font-medium text-base"
            >
                Name
            </label>
            <input class="input input-bordered w-full max-w-lg"
                id="name"
                name="name"
                id="name"
                type="text"
                placeholder="Input Name"
                value="{{ $company->name }}"
            >
            <label for="city"
                class="py-1 font-medium text-base"
            >
                City
            </label>
            <input class="input input-bordered w-full max-w-lg"
                id="city"
                name="city"
                id="city"
                type="text"
                placeholder="Input City"
                value="{{ $company->city }}"
            >
            <label for="country"
                class="py-1 font-medium text-base"
            >
                Country
            </label>
            <input class="input input-bordered w-full max-w-lg"
                id="country"
                name="country"
                id="country"
                type="text"
                placeholder="Input Country"
                value="{{ $company->country }}"
            >
            <label for="description"
                class="py-1 font-medium text-base"
            >
                Description
            </label>
            <input class="input input-bordered w-full max-w-lg"
                id="description"
                name="description"
                id="description"
                type="text"
                placeholder="Input Description"
                value="{{ $company->description }}"
            >
            <button class="btn bg-primary text-white mt-4 m-auto">
                Update
            </button>
        </form>
    </div>
</dialog>
