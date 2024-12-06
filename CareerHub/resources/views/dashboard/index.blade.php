@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @foreach ($jobs as $job)
        <x-employee_job_card :job="$job" />
    @endforeach
</div>
@endsection
