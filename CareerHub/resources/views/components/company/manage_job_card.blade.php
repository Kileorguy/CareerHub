<div class="w-72 flex flex-col gap-4 overflow-x-hidden p-6 shadow-lg border rounded-lg relative">
    <p class="text-lg font-bold">{{ $job->job_name }}</p>
    <div class="h-52 overflow-y-auto ">
        <p class="mt-2 text-sm font-semibold text-gray-500">
            Job description
        </p>
        <p>{{ $job->job_description }}</p>

        <p class="mt-2 text-sm font-semibold text-gray-500">
            Job level
        </p>
        <p>{{ $job->job_level }}</p>

        <p class="mt-2 text-sm font-semibold text-gray-500">
            Job Skills
        </p>
        <ul class="grid grid-cols-2 list-disc list-inside">
            @foreach ($job->job_skills as $skill)
                <li> {{ $skill->skill_name }}</li>
            @endforeach
        </ul>
    </div>
    <span class="w-full flex justify-evenly">
        <x-company.delete_job_form :job="$job" />
        <x-company.job_form :type="'Edit'" :job="$job" />
    </span>
</div>
<script src="./js/job-skill-input.js"></script>
