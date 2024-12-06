@if ($type == 'Edit')
    <button class="btn"
        onclick="document.querySelector('[data-job-form-id=\'edit-job-{{ $job->id }}\']').showModal()">Edit</button>
@else
    <button class="btn btn-circle btn-ghost text-2xl p-0"
        onclick="document.querySelector('[data-job-form-id=\'add-job-form\']').showModal()">+</button>
@endif

<dialog class="modal" data-job-form-id="{{ $type == 'Edit' ? 'edit-job-' . $job->id : 'add-job-form' }}">
    <div class="modal-box">
        <form method="dialog">
            <button type="button" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                onclick="this.closest('dialog').close()">✕</button>
        </form>
        <h3 class="text-xl font-bold pb-4">{{ $type }} Job</h3>

        <form class="flex flex-col justify-start items-start"
            action="{{ $type == 'Edit' ? '/updateJob/' . $job->id : '/addJob' }}" method="POST">
            @csrf

            <!-- Job Skills -->
            <input type="hidden" name="job_skills" data-scope="job-skills"
                value="{{ $type == 'Edit' ? json_encode($job->job_skills->pluck('skill_name')->toArray()) : '[]' }}">

            <!-- Job Name -->
            <label class="py-1 font-medium text-base">Job Name</label>
            <input class="input input-bordered w-full max-w-lg" id="job-name-{{ $type == 'Edit' ? $job->id : 'new' }}"
                name="job_name" type="text" placeholder="Input Job Name"
                value="{{ $type == 'Edit' ? $job->job_name : old('job-name') }}">

            <!-- Job Description -->
            <label class="py-1 font-medium text-base">Job Description</label>
            <input class="input input-bordered w-full max-w-lg"
                id="job-description-{{ $type == 'Edit' ? $job->id : 'new' }}" name="job_description" type="text"
                placeholder="Input Job Description"
                value="{{ $type == 'Edit' ? $job->job_description : old('job-description') }}">

            <!-- Job Level -->
            <label class="py-1 font-medium text-base">Job Level</label>
            <select class="select select-bordered w-full" id="job-level-{{ $type == 'Edit' ? $job->id : 'new' }}"
                name="job_level">
                <option value="Mid senior"
                    {{ $type == 'Edit' && $job->job_level == 'Mid senior' ? 'selected' : '' }}>Mid senior</option>
                <option value="Associate" {{ $type == 'Edit' && $job->job_level == 'Associate' ? 'selected' : '' }}>
                    Associate</option>
            </select>

            <!-- Job Skills List -->
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
