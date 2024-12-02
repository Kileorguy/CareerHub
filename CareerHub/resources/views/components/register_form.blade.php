<script src="./js/register-form-render.js" defer></script>
<form action="/register" method="POST" class="w-96 h-fit bg-white rounded-lg p-10 flex flex-col gap-4">
  @csrf
  <p class="font-bold text-2xl text-black mb-4">CareerHub</p>
  <div class="default-detail-form flex flex-col items-center justify-center gap-4">
    <input name="email" type="email" placeholder="E-mail" value="{{ old('email') }}"
      class="w-full h-fit p-2 input input-bordered" />
    <input name="password" type="password" placeholder="Pasword" value="{{ old('password') }}"
      class="w-full h-fit p-2 input input-bordered" />
    <input name="password_confirmation" type="password" placeholder="Confirm Pasword"
      value="{{ old('password_confirmation') }}" class="w-full h-fit p-2 input input-bordered" />
  </div>
  <select name="role" class="select select-bordered w-full text-md px-2" id="role">
    <option value="Employee" {{ old('role')=='Employee' ? 'selected' : '' }}>Employee</option>
    <option value="Company" {{ old('role')=='Company' ? 'selected' : '' }}>Company</option>
  </select>
  <div id="employee-detail-form" class="hidden flex-col items-center justify-center gap-4">
    <span class="flex gap-4">
      <input name="first_name" type="text" placeholder="First Name" value="{{ old('first_name') }}"
        class="w-1/2 h-fit p-2 input input-bordered" />
      <input name="last_name" type="text" placeholder="Last Name" value="{{ old('last_name') }}"
        class="w-1/2 h-fit p-2 input input-bordered" />
    </span>
  </div>
  <div id="company-detail-form" class="w-full hidden flex-col items-center gap-4">
    <input name="name" type="text" placeholder="Company Name" value="{{ old('name') }}"
      class="w-full h-fit p-2 input input-bordered">
    <input name="country" type="text" placeholder="Country" value="{{ old('country') }}"
      class="w-full h-fit p-2 input input-bordered">
    <input name="city" type="text" placeholder="City" value="{{ old('city') }}"
      class="w-full h-fit p-2 input input-bordered">
    <input name="description" type="text" placeholder="Description" value="{{ old('description') }}"
      class="w-full h-fit p-2 input input-bordered">
  </div>
  <button type="submit" class="w-full btn btn-primary text-white">Register </button>
  <div class="min-h-4 text-center">
    @if ($errors->any())
    <p class="text-red-600 text-xs">{{ $errors->first() }}</p>
    @endif
  </div>
  <a href="{{ url('/login') }}" class="text-xs cursor-pointer text-center">
    Already have an account?
    <span class="text-primary font-bold">Sign in</span>
  </a>
</form>
