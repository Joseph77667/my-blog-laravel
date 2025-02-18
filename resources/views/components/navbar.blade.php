<nav class="navbar p-fixed navbar-dark bg-dark"> 
    <div class="container">
        <a href="/" class="navbar-brand">MyLogo</a>
        <div class="d-flex">
            <a href="/" class="nav-link text-white">Blogs</a>

            {{-- @if (auth()->user->is_admin)
            <a href="/admin/blogs" class="nav-link text-white">Create Blog</a>
            @endif --}}

            @guest
            <a href="/register" class="nav-link text-white">Register</a>
            <a href="/login" class="nav-link text-white">Login</a>           
            @endguest

            @auth
            @can('admin')
            <a href="/admin/blogs"
             class="nav-link text-white">Dashboard</a>
            @endcan
            <img 
            src="{{auth()->user()->avatar}}" 
            width="50"
            height="50"
            class="rounded-circle"
            alt="">

            <a href="" class="nav-link ">Welcome {{auth()->user()->name}}</a>
            <form action="/logout" method="POST">
                @csrf
                <button href="" 
                type="submit"
                class="nav-link text-white btn btn-link">
                Logout</button>
            </form>
            @endauth

            <a href="" class="nav-link text-white">Subscribe</a>
        </div>
    </div>
</nav>