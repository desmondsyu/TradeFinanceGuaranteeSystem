<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white font-bold text-xl">Inventory Management</div>
        <ul class="flex space-x-4 text-white">
            <li><a href="" class="hover:underline">Create</a></li>
            <li><a href="" class="hover:underline">Review</a></li>
            <li><a href="" class="hover:underline">Apply</a></li>
            <li><a href="" class="hover:underline">Issue</a></li>
            <li><a href="" class="hover:underline">Upload</a></li>
            <li>
                @auth
                    <a href="{{ route('logout') }}" class="hover:text-gray-400">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-400">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-gray-400">Register</a>
                @endauth
            </li>
        </ul>
    </div>
</nav>
