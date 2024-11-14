<div class="flex p-8 rounded-lg border-2 justify-around mb-5" style="width: 900px;">
    <div class="flex items-start gap-5">
        <img src="{{ asset('assets/slcImage.png') }}" alt="Image Description">
        <div class="flex flex-col items-start">
            <p class="text-primary font-bold text-xl text-left">{{$position}}</p>
            <p class="font-semibold text-main-text text-base">{{$company}}</p>
            <p class="text-sub-text text-sm">{{$location}}</p>
        </div>
    </div>
    <div class="border-l border-gray-300 mx-4"></div>
    <div class="flex flex-col items-start w-96">
        <p class="text-main-text font-bold">Job Description:</p>
{{--        <p>{{$summary}}</p>--}}
        <ul class="list-disc pl-5">
            @foreach($jobs as $job)
                <li class="text-sub-text text-left">
                    {{$job->job_description}}
                </li>

            @endforeach

        </ul>
        <p class="text-primary">View more</p>
    </div>
</div>
