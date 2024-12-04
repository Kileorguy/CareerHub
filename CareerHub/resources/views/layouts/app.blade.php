<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CareerHub</title>
  @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen bg-background">
  @include('components.navbar')

  <div class="container mx-auto flex-grow">
    @yield('content')
  </div>

  {{-- TODO: include footer kalau ada --}}

</body>

</html>
