<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('user.includes.styles')
    @yield('styles')
</head>
<body class="bg-gray-50">
    <!-- Mobile Menu Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Sticky Header -->
    @include('user.includes.header')
    

    <!-- Mobile Menu Drawer -->
    
    @yield('content')
     

   
     <!-- Footer -->
    
    @include('user.includes.footer')
    @include('user.includes.scripts')
    @yield('scripts')
    
</body>
</html>