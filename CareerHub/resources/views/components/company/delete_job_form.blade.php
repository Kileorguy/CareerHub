<button class="btn bg-red-500 text-white w-full flex-1"
  onclick="document.querySelector('[data-delete-form-id=\'delete-job-form-{{ $job->id }}\']').showModal()">
  Delete
</button>

<dialog data-delete-form-id="delete-job-form-{{ $job->id }}" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
        onclick="document.querySelector('[data-delete-form-id=\'delete-job-form-{{ $job->id }}\']').close()">✕</button>
    </form>
    <h3 class="text-xl font-bold pb-4">Delete Job</h3>

    <form class="flex flex-col justify-start items-start" action="/deleteJob" method="POST">
      @csrf
      <input type="hidden" name="job_id" value="{{ $job->id }}">
      <label for="job_title" class="text-lg font-bold">
        Are you sure you want to delete this job?
      </label>
      <label>{{ $job->job_name }}</label>
      <span class="mt-4 m-auto flex gap-4">
        <button class="btn" type="button" onclick="document.getElementById('delete-job').close()">
          Cancel
        </button>
        <button class="btn bg-red-500 text-white">
          Confirm
        </button>
      </span>
    </form>
  </div>
</dialog>