<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body class="w-screen h-screen flex justify-center items-center bg-gradient-to-br from-background to-primary">
    <form action="{{ route('register') }}" method="POST"
        class="w-96 min-h-96 bg-white flex flex-col items-center justify-center rounded-lg p-10 gap-4">
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
        <input name="password_confirmation" type="password" placeholder="Confirm Pasword" value="{{ old('password_confirmation') }}"
            class="w-full h-fit p-2 input input-bordered" />
        <select name="role" class="select select-bordered w-full">
            <option value="Employee">Employee</option>
            <option value="Company">Company</option>
        </select>
        <button type="submit" class="w-full btn btn-primary text-white">Register </button>
        <div class="min-h-4">
            @if ($errors->any())
                <p class="text-red-600 text-xs">{{ $errors->first() }}</p>
            @endif
        </div>
        <a href="{{ url('/login') }}" class="text-xs cursor-pointer">Already have an account? <span
                class="text-primary font-bold">Sign in</span></a>
    </form>
</body>

</html>
