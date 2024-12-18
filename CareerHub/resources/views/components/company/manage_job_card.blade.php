<div
  class="flex flex-col gap-4 overflow-x-hidden p-6 shadow-lg border border-input-light rounded-lg relative max-h-full overflow-y-auto">
  <p class="text-lg font-bold">{{ $job->job_name }}</p>
  <div class="h-52 overflow-y-auto ">
    <p class="mt-2 text-md font-semibold text-main-text">
      Job description
    </p>
    <p class="text-sub-text text-sm">{{ $job->job_description }}</p>
    <p class="mt-2 text-md font-semibold text-main-text">
      Job level
    </p>
    <p class="text-sub-text text-sm">{{ $job->job_level }}</p>
    <p class="mt-2 text-md font-semibold text-main-text">
      Job Skills
    </p>
    <ul class="grid grid-cols-2 list-disc list-inside">
      @foreach ($job->job_skills as $skill)
      <li class="text-sub-text text-sm"> {{ $skill->skill_name }}</li>
      @endforeach
    </ul>
  </div>
  <span class="w-full flex justify-evenly gap-2">
    <x-company.job_form :type="'Edit'" :job="$job" />
    <x-company.delete_job_form :job="$job" />
  </span>
</div>