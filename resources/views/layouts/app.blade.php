<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pengelolaan Penjualan Sayuran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-300 flex flex-col min-h-screen pt-16">
    @include('components.navbar')
    
    <main class="flex-grow container mx-auto px-4 py-6">
        @yield('content')
    </main>
    
    @include('components.footer')
</body>
</html>