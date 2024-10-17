<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
    <script src="{{ asset('js/registerFormRender.js') }}"></script>
</head>

<body class="w-screen min-h-screen flex justify-center py-12 bg-gradient-to-br from-background to-primary">
    <form action="/register" method="POST"
        class="w-96 h-fit bg-white flex flex-col items-center justify-center rounded-lg p-10 gap-4">
        @csrf
        <p class="font-bold text-2xl text-black mb-4">CareerHub</p>
        <span class="flex gap-4">
            <input name="first_name" type="text" placeholder="First Name" value="{{ old('first_name') }}"
            class="w-1/2 h-fit p-2 input input-bordered" />
            <input name="last_name" type="text" placeholder="Last Name" value="{{ old('last_name') }}"
            class="w-1/2 h-fit p-2 input input-bordered" />
        </span>
        <input name="email" type="email" placeholder="E-mail" value="{{ old('email') }}"
            class="w-full h-fit p-2 input input-bordered" />
        <input name="password" type="password" placeholder="Pasword" value="{{ old('password') }}"
            class="w-full h-fit p-2 input input-bordered" />
        <input name="password_confirmation" type="password" placeholder="Confirm Pasword"
            value="{{ old('password_confirmation') }}" class="w-full h-fit p-2 input input-bordered" />
        <select name="role" class="select select-bordered w-full text-md px-2" id="role">
            <option value="Employee" {{ old('role') == 'Employee' ? 'selected' : '' }}>Employee</option>
            <option value="Company" {{ old('role') == 'Company' ? 'selected' : '' }}>Company</option>
        </select>
        <div id="company-detail-form" class="w-full hidden flex-col items-center gap-4">
            <input name="company_name" type="text" placeholder="Company Name" value="{{ old('company_name') }}"
                class="w-full h-fit p-2 input input-bordered">
            <input name="country" type="text" placeholder="Country" value="{{ old('country') }}"
                class="w-full h-fit p-2 input input-bordered">
            <input name="location" type="text" placeholder="Location" value="{{ old('location') }}"
                class="w-full h-fit p-2 input input-bordered">
            <input name="city" type="text" placeholder="City" value="{{ old('city') }}"
                class="w-full h-fit p-2 input input-bordered">
            <input name="position_name" type="text" placeholder="Position Name" value="{{ old('position_name') }}"
                class="w-full h-fit p-2 input input-bordered">
            <input name="job_level" type="text" placeholder="Job Level" value="{{ old('job_level') }}"
                class="w-full h-fit p-2 input input-bordered">
            <textarea name="job_summary" placeholder="Job Summary"
                class="textarea textarea-bordered textarea-md w-full p-2 text-base">
                {{ old('job_summary') }}
            </textarea>
        </div>
        <button type="submit" class="w-full btn btn-primary text-white">Register </button>
        <div class="min-h-4">
            @if ($errors->any())
                <p class="text-red-600 text-xs">{{ $errors->first() }}</p>
            @endif
        </div>
        <a href="{{ url('/login') }}" class="text-xs cursor-pointer">
            Already have an account?
            <span class="text-primary font-bold">Sign in</span>
        </a>
    </form>
</body>

</html>
