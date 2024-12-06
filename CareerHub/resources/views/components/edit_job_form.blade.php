<button class="btn" onclick="document.querySelector('[data-update-form-id=\'edit-job-{{ $job->id }}\']').showModal()">Edit</button>

<dialog class="modal" data-update-form-id="edit-job-{{ $job->id }}">
    <div class="modal-box">
        <form method="dialog">
            <button type="button" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                onclick="this.closest('dialog').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">Edit Job</h3>
        <form class="flex flex-col justify-start items-start" action="/updateJob" method="POST">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}" />
            <input type="hidden" name="job_skills" data-scope="job-skills" value="{{ json_encode($job->job_skills->pluck('skill_name')->toArray()) }}">
            <label class="py-1 font-medium text-base">Job Name</label>
            <input class="input input-bordered w-full max-w-lg" id="job-name-{{ $job->id }}" name="job_name" type="text"
                placeholder="Input Job Name" value="{{ $job->job_name }}">
            <label class="py-1 font-medium text-base">Job Description</label>
            <input class="input input-bordered w-full max-w-lg" id="job-description-{{ $job->id }}" name="job_description"
                type="text" placeholder="Input Job Description" value="{{ $job->job_description }}">
            <label class="py-1 font-medium text-base">Job Level</label>
            <select class="select select-bordered w-full" id="job-level-{{ $job->id }}" name="job_level">
                <option value="Mid senior">Mid senior</option>
                <option value="Associate">Associate</option>
            </select>
            <label class="py-1 font-medium text-base">Job Skills</label>
            <ul data-scope="job-skill-list" class="grid grid-cols-2 w-full gap-x-8 mb-2 list-disc list-inside"></ul>
            <span class="flex w-full gap-2">
                <input class="input input-bordered w-full max-w-lg" data-scope="temporary-skill" type="text"
                    placeholder="Input Job Skills">
                <button type="button" class="btn aspect-square text-2xl p-0" data-scope="add-skill-btn">+</button>
            </span>
            <button class="btn bg-primary text-white mt-4 m-auto">Confirm</button>
        </form>
    </div>
</dialog>
