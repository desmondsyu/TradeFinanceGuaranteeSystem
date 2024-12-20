<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Add your CSS frameworks or custom styles here -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="antialiased">
    <!-- Navigation Bar -->
    <nav class="bg-gray-800 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <!-- App Name -->
            <div class="text-lg font-bold">
                <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <!-- Navigation Links -->
            <div>
                <ul class="flex space-x-4">
                    @auth
                        <li><a href="{{ route('guarantees.create') }}" class="hover:underline text-blue-500">Create</a></li>
                        <li><a href="{{ route('guarantees.index', ['status' => 'New']) }}" class="hover:underline ">New</a>
                        </li>
                        <li><a href="{{ route('guarantees.index', ['status' => 'Submitted']) }}"
                                class="hover:underline">Review</a></li>
                        <li><a href="{{ route('guarantees.index', ['status' => 'Reviewed']) }}"
                                class="hover:underline">Apply</a></li>
                        <li><a href="{{ route('guarantees.index', ['status' => 'Applied,Issued']) }}"
                                class="hover:underline">Issue</a></li>
                        <li><a href="{{route('files.index')}}" class="hover:underline">Upload</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="hover:underline text-red-500">Logout</button>
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
    <!-- Main Content -->
    <main class="container mx-auto mt-4">
        @yield('content')
    </main>
</body>

</html>
