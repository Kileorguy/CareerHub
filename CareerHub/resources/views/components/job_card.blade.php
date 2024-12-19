<div class="w-full bg-white flex gap-6 m-4 p-6 rounded-lg shadow-lg">
  <a class="w-[400px]" href="{{route('companyDetail', $job->company)}}">
    <img src="{{ $job->company->user->profile_link ?? '/assets/profile-empty.png' }}"
      class="w-full border rounded-lg object-cover" alt="job image">
  </a>

  <div class="w-full border-r">
    <a href="{{route('companyDetail', $job->company)}}">
      <p class="text-left text-black font-bold text-lg hover:underline"> {{ $job->company->name }} </p>
    </a>
    <p class="text-left text-gray-500 font-bold text-base"> {{ $job->company->city }}, {{ $job->company->country }} </p>
  </div>

  <div class="flex flex-col justify-between items-start w-full py-2 pl-2">
    <div class="w-full">
      <p class="text-left text-black font-bold text-base w-full">Job Description:</p>
      <p class="text-gray-500 text-justify text-sm overflow-y-hidden max-h-[138px]">{{ $job->job_description }}</p>
    </div>
    <a href="{{ route('jobDetail', ['id' => $job->id]) }}" class="btn btn-ghost text-primary p-2">
      View more
    </a>
  </div>
</div>