<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>CRUD ZIPP</title>
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="https://comprezipp.com/favicon.ico">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
  <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
  <link href=" {{ asset('argon') }}/css/argon.css " rel="stylesheet" type="text/css" />
  <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>

<body>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  @yield('main')
  @yield('unidade')
  <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('argon') }}/js/argon.js" type="text/js"></script>

  <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  @stack('js')

  <!-- Argon JS -->
  <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
</body>

</html>