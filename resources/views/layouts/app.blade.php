<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HugsyWugsy')</title>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">


<style>

</style>
    <!-- Link the CSS -->


<!-- Link the JS -->




    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    @stack('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
<body style="background-color: #FFD6E3;">
    
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    @stack('scripts')


</body>
</html>
