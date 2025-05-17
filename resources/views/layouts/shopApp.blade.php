<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HugsyWugsy Shop</title>
    <link rel="stylesheet" href="{{ asset('css/shop_styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
 
    @yield('extra_css')
</head>

<body>
    <!-- HEADER -->
    @include('partials.header')
    

    @yield('content')

    <!-- FOOTER -->
    <footer>
        <p>© {{ date('Y') }} HugsyWugsy. All rights reserved.</p>
        <p>Payment Methods: Visa, Mastercard, PayPal</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>