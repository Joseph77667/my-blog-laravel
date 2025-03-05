<!-- Navbar -->
<nav class="navbar p-fixed bg-slate-700">
    <div class="container flex items-center align-middle">
        <a href="/" class="navbar-brand text-white">MyLogo</a>
        <div class="flex gap-x-5">
            <a href="/home" class="nav-link {{request()->is('home') ? 'text-blue-500' : 'text-white'}}">Home</a>
            <a href="/" class="nav-link {{request()->is('/') ? 'text-blue-500' : 'text-white'}}">Blogs</a>

            @guest
                <a href="/register"
                    class="nav-link {{request()->is('register') ? 'text-blue-500' : 'text-white'}}">Register</a>
                <a href="/login" class="nav-link {{request()->is('login') ? 'text-blue-500' : 'text-white'}}">Login</a>
            @endguest

            @auth
                @can('admin')
                    <a href="/admin/blogs"
                        class="nav-link {{request()->is('admin/blogs') ? 'text-blue-500' : 'text-white'}}">Dashboard</a>
                @endcan

                <!-- User Dropdown -->
                <div x-data="{ openMain: false, openProfile: false }" class="relative inline-block text-left">
                    <!-- Avatar Button -->
                    <a @click="openMain = !openMain" class="items-center w-full cursor-pointer">
                        <img src="{{ asset( auth()->user()->avatar) }}"  
                        width="60" height="60" class="rounded-full"
                        alt="User Avatar">
                    </a>

                    <!-- Main Dropdown Menu -->
                    <ul x-show="openMain" @click.away="openMain = false"
                        class="absolute right-0 z-10 mt-3 w-48 bg-white rounded-md shadow-lg border border-gray-200">
                        <li>
                            <a @click="openProfile = !openProfile"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                                My Profile
                            </a>

                            <!-- Nested Profile Dropdown -->
                            <ul x-show="openProfile" @click.away="openProfile = false"
                                class="absolute right-full mr-2 z-10 top-0 w-60 max-w-[250px] bg-white rounded-md shadow-lg border border-gray-200">
                                <li class="p-4 text-center">
                                    <!-- User Avatar -->
                                    <img src="{{ asset(auth()->user()->avatar) }}" 
                                     width="80" height="80"
                                        class="rounded-full mx-auto mb-2 border-2 border-gray-300" alt="User Avatar">

                                    <!-- Edit Avatar Button -->
                                    <label for="avatarInput" class="block text-sm text-blue-500 cursor-pointer hover:underline">
                                        <a href="/user/{{ auth()->user()->id }}/edit">Edit Photo</a>
                                    </label>

                                    <h2 class="text-lg font-bold">Name : {{ auth()->user()->name }}</h2>
                                    <p class="text-sm text-gray-600">Email : {{ auth()->user()->email }}</p>
                                    <p class="text-sm text-gray-600">Joined :
                                        {{ auth()->user()->created_at->format('M d, Y') }}</p>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    function previewAndSubmit() {
        let file = document.getElementById("avatarInput").files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("avatarPreview").src = e.target.result;
            };
            reader.readAsDataURL(file);
            document.getElementById("avatarForm").submit(); // Auto-submit after selecting file
        }
    }
</script>

<!-- Load Alpine.js (Add this if it's not already included in your project) -->
<script src="//unpkg.com/alpinejs" defer></script>