<!doctype html>
<html class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <meta name="csrf-token" content="{{ csrf_token() }}">

  @vite('resources/css/app.css')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js"></script>

</head>
<body class="text-gray-800 dark:text-gray-200 ">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 pt-24">
    <x-layout.navbar></x-layout.navbar>
    {{ $slot }}
    <x-layout.footer></x-layout.footer>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
