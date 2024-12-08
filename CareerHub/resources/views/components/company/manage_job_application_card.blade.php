<div class="flex gap-6 p-6 rounded-lg shadow-lg border bg-white">
    <img src=" {{ $jobApplication->user->profile_link ?? '/assets/profile-empty.png' }} "
        class="w-24 h-24 rounded-lg object-cover">
    <div class="w-full">
        <p class="text-lg font-bold text-black"> {{ $jobApplication->user->first_name }}
            {{ $jobApplication->user->last_name }} </p>
        <p class="font-bold text-gray-500"> {{ $jobApplication->user->email }} </p>
    </div>
    <div class="flex items-end gap-4 justify-end">
        <form method="POST"
            action="{{ route('updateJobApplicationStatus', [
                'job_id' => $jobApplication->job_id,
                'user_id' => $jobApplication->user_id,
            ]) }}"
            >
            @csrf
            <input type="hidden" name="status" value="Accepted">
            <button class="btn bg-green-500 text-white w-24">Accept</button>
        </form>
        <form method="POST"
            action="{{ route('updateJobApplicationStatus', [
                'job_id' => $jobApplication->job_id,
                'user_id' => $jobApplication->user_id,
            ]) }}"
            >
            @csrf
            <input type="hidden" name="status" value="Rejected">
            <button class="btn bg-red-500 text-white w-24">Reject</button>
    </div>
</div>
