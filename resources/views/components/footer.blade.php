<footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto px-4">
        <!-- Navigation Links -->
        <ul class="flex justify-center space-x-6 mb-2">
            <li>
                <a href="/home" class="hover:text-blue-400 transition">Home</a>
            </li>
            <li>
                <a href="/" class="hover:text-blue-400 transition">Blogs</a>
            </li>
            @guest
                <li>
                    <a href="/register" class="hover:text-blue-400 transition">Register</a>
                </li>
                <li>
                    <a href="/login" class="hover:text-blue-400 transition">Login</a>
                </li>
            @endguest
            @auth
                @can('admin')
                    <li>
                        <a href="/admin/blogs" class="hover:text-blue-400 transition">Dashboard</a>
                    </li>
                @endcan
                <a href="/logout" class="hover:text-blue-400 transition">Logout</a>
            @endauth
            
        </ul>
        
        <!-- Social Media Links -->
        <div class="flex justify-center space-x-4 mb-4">
            <a href="#" class="hover:text-blue-400 transition">
                <i class="fab fa-facebook-f"></i> <!-- Font Awesome Facebook Icon -->
            </a>
            <a href="#" class="hover:text-blue-400 transition">
                <i class="fab fa-twitter"></i> <!-- Font Awesome Twitter Icon -->
            </a>
            <a href="#" class="hover:text-blue-400 transition">
                <i class="fab fa-instagram"></i> <!-- Font Awesome Instagram Icon -->
            </a>
            <a href="#" class="hover:text-blue-400 transition">
                <i class="fab fa-linkedin-in"></i> <!-- Font Awesome LinkedIn Icon -->
            </a>
        </div>

        <!-- Address Section -->
        <div class="text-center mb-4">
            <p class="text-sm">123 Blog Street,</p>
            <p class="text-sm">Blog City, BC 12345</p>
            <p class="text-sm">Email: info@blogsbympaa.com</p>
        </div>

        <!-- Copyright Section -->
        <p class="text-center text-sm">
            &copy; {{ date('Y') }} Blogs By Mpaa, Inc. All rights reserved.
        </p>
    </div>
</footer>