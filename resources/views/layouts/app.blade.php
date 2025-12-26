<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title') - MyApp</title>
    
    <!-- CSS Vite -->
    @vite(['resources/css/app.css'])
    
    <!-- Styles tambahan per halaman -->
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50">
    <!-- HEADER/NAVBAR -->
    <header class="bg-white shadow">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="/" class="text-xl font-bold text-blue-600">MyApp</a>
                <div class="space-x-4">
                    @auth
                        <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-600">Login</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="container mx-auto px-4 py-8">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc ml-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- CONTENT DINAMIS -->
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} MyApp. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript Vite -->
    @vite(['resources/js/app.js'])
    
    <!-- Scripts tambahan per halaman -->
    @stack('scripts')
</body>
</html>