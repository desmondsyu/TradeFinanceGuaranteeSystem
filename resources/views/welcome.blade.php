<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 antialiased">
    <!-- Navigation Bar -->
    <nav class="bg-gray-800 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold">
                <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <div>
                <ul class="flex space-x-4">
                    @auth
                        <li><a href="{{ route('categories.index') }}" class="hover:underline">Categories</a></li>
                        <li><a href="{{ route('suppliers.index') }}" class="hover:underline">Suppliers</a></li>
                        <li><a href="{{ route('inventory.index') }}" class="hover:underline">Inventories</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="hover:underline">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:underline">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome Page Content -->
    <div class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to {{ config('app.name', 'Laravel') }}</h1>
            <p class="text-gray-600 mb-8">Manage your inventory with ease and efficiency.</p>
            @guest
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 ml-2">
                    Register
                </a>
            @endguest
        </div>
    </div>
</body>
</html>
