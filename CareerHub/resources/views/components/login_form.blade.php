<form action="/login" method="POST"
    class="size-96 bg-white flex flex-col items-center justify-center rounded-lg p-10 gap-4">
    @csrf
    <p class="font-bold text-2xl text-black mb-4">CareerHub</p>
    <input name="email" type="email" placeholder="E-mail" value="{{ old('email') }}"
        class="w-full h-fit p-2 input input-bordered" />
    <input name="password" type="password" placeholder="Pasword" value="{{ old('password') }}"
        class="w-full h-fit p-2 input input-bordered" />
    <button type="submit" class="w-full btn btn-primary text-white">Login </button>
    <div class="min-h-4">
        @if ($errors->any())
            <p class="text-red-600 text-xs">{{ $errors->first() }}</p>
        @endif
    </div>
    <a href="{{ url('/register') }}" class="text-xs cursor-pointer">
        Don't have an account?
        <span class="text-primary font-bold">Sign up</span>
    </a>
</form>
