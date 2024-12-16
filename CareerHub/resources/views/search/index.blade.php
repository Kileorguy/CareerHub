@extends('layouts.app')

@section('content')
<div class="container mt-7 flex gap-6 mb-10">
  <div
    class="filter-section form-control bg-white w-[250px] p-5 rounded-md flex flex-col border border-input-light h-fit sticky top-[94px] shadow-lg">
    <div class="text-lg font-bold mb-4">Filter</div>
    <div class="flex flex-col gap-2">
      <div class="flex items-center gap-2">
        <input id="company" type="checkbox" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
        <label for="company">Company</label>
      </div>
      <div class="flex items-center gap-2">
        <input id="job" type="checkbox" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
        <label for="job">Job</label>
      </div>
    </div>
  </div>
  <div class="result-section flex flex-col gap-5 w-full">
    <div class="company-result">
      <div
        class="bg-white p-5 flex-1 border border-input-light {{ $companies->count() >= 3 ? 'rounded-t-md' : 'rounded-md' }} shadow-lg">
        <div class="font-bold text-3xl">Companies</div>
        @if ($companies->count() == 0)
        <div class="text-sub-text text-center py-5 text-lg">No result</div>
        @endif
        <div class="company-section flex flex-col">
          @foreach($companies as $company)
          <div class="flex gap-5 {{ $loop->last ? 'pt-8 pb-4' : 'border-b py-8' }} border-input-light">
            <div class="left w-[120px] flex-shrink-0">
              <img src="{{$company->user->profile_link ?? 'assets/profile-empty.png'}}" alt="Company Image">
            </div>
            <div class="right">
              <a href="{{route('companyDetail', $company)}}"
                class="text-primary name font-semibold text-xl hover:underline">{{$company->name}}</a>
              <div class="location text-main-text">{{$company->city}},{{$company->country}}</div>
              <p class="description text-sub-text text-sm">{{Str::limit($company->description, 200, '...')}}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @if ($moreCompanies)
      <a href="{{route('moreCompanies', ['query' => request('query')])}}">
        <div
          class="bg-white border-b border-x border-input-light rounded-b-xl p-5 hover:bg-gray-100 text-center font-semibold transition-all text-main-text shadow-lg">
          See all company result
        </div>
      </a>
      @endif
    </div>

    <div class="job-result">
      <div
        class="bg-white p-5 flex-1 border border-input-light {{ $jobs->count() >= 3 ? 'rounded-t-md' : 'rounded-md' }} shadow-lg">
        <div class="font-bold text-3xl">Jobs</div>
        @if ($jobs->count() == 0)
        <div class="text-sub-text text-center py-5 text-lg">No result</div>
        @endif
        <div class="job-section flex flex-col">
          @foreach($jobs as $job)
          <div class="flex gap-5 {{ $loop->last ? 'pt-8 pb-4' : 'border-b py-8  ' }} border-input-light py-8">
            <div class="left w-[120px] flex-shrink-0">
              <img src="{{$job->company->user->profile_link ?? 'assets/profile-empty.png'}}" alt="Company Image">
            </div>
            <div class="right">
              <div class="flex gap-3 items-center">
                <a href="{{route('jobDetail', $job->id)}}"
                  class="text-primary name font-semibold text-xl hover:underline">{{$job->job_name}}</a>
                <div class="badge badge-outline">{{$job->job_level}}</div>
              </div>
              <div class="location text-main-text">{{$job->company->city}},{{$job->company->country}}</div>
              <p class="description text-sub-text text-sm">{{ Str::limit($job->job_description, 200, '...') }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @if ($moreJobs)
      <a href="{{route('moreJobs', ['query' => request('query')])}}">
        <div
          class="bg-white border-b border-x rounded-b-xl p-5 hover:bg-gray-100 text-center font-semibold transition-all text-main-text shadow-lg">
          See all job results
        </div>
      </a>
      @endif
    </div>
  </div>
</div>

<div id="toast" class="toast toast-top toast-end z-50 hidden">
  <div class="alert alert-error">
    <span id="toast-message">At least one filter must be selected.</span>
  </div>
</div>

@endsection


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const companyCheckbox = document.getElementById('company');
    const jobCheckbox = document.getElementById('job');
    const companyResult = document.querySelector('.company-result');
    const jobResult = document.querySelector('.job-result');
    const toast = document.getElementById('toast');

    function showToast(message) {
      const toastMessage = document.getElementById('toast-message');
      toastMessage.textContent = message;
      toast.classList.remove('hidden');
      setTimeout(() => {
        toast.classList.add('hidden');
      }, 3000);
    }

    function validateCheckboxes() {
      if (!companyCheckbox.checked && !jobCheckbox.checked) {
        showToast('At least one filter must be selected.');
        return false;
      }
      return true;
    }

    companyCheckbox.addEventListener('change', function () {
      if (!validateCheckboxes()) {
        companyCheckbox.checked = true;
      } else {
        companyResult.style.display = companyCheckbox.checked ? 'block' : 'none';
      }
    });

    jobCheckbox.addEventListener('change', function () {
      if (!validateCheckboxes()) {
        jobCheckbox.checked = true;
      } else {
        jobResult.style.display = jobCheckbox.checked ? 'block' : 'none';
      }
    });
  });
</script>