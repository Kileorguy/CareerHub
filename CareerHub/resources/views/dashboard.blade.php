@extends('layouts.app')

@section('content')
<div class="container mt-10">
    @foreach ($jobs as $job)
        <x-job_card :job="$job" />
    @endforeach
</div>
@endsection
