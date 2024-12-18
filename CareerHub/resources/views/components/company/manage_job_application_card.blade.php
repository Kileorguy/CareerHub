<div class="flex flex-col p-6 rounded-lg shadow-lg border bg-white">
  <div class="flex gap-6">
    <img src=" {{ $jobApplication->user->profile_link ?? '/assets/profile-empty.png' }} "
      class="w-24 h-24 rounded-lg object-cover">
    <div class="w-full">
      <a href="{{route('employeeDetail', $jobApplication->user)}}"
        class="text-lg font-bold text-primary hover:underline">
        {{ $jobApplication->user->first_name }}
        {{ $jobApplication->user->last_name }} </a>
      <p class="font-bold text-main-text text-sm"> {{ $jobApplication->user->email }} </p>
      <div class="text-sm text-sub-text">
        Applying for '{{$jobApplication->job->job_name}}' position
      </div>
    </div>
  </div>
  <div class="flex justify-end h-fit">
    <form class="mb-0" method="POST" action="{{ route('updateJobApplicationStatus', [
                'job_id' => $jobApplication->job_id,
                'user_id' => $jobApplication->user_id,
            ]) }}">
      @csrf
      <input type="hidden" name="status" value="Accepted">
      <button class="btn bg-green-500 text-white w-24">Accept</button>
    </form>
    <form class="mb-0" method="POST" action="{{ route('updateJobApplicationStatus', [
                'job_id' => $jobApplication->job_id,
                'user_id' => $jobApplication->user_id,
            ]) }}">
      @csrf
      <input type="hidden" name="status" value="Rejected">
      <button class="btn bg-red-500 text-white w-24">Reject</button>
  </div>
</div>