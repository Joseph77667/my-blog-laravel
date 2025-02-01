<nav class="navbar p-fixed navbar-dark bg-dark"> 
    <div class="container">
        <a href="/" class="navbar-brand">MPSS</a>
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
            <a href="" class="nav-link text-white">Welcome {{auth()->user()->name}}</a>
            <form action="/logout" method="POST">
                @csrf
                <button href="" 
                class="nav-link text-white btn btn-link">
                Logout</button>
            </form>
            @endauth

            <a href="" class="nav-link text-white">Subcribe</a>
        </div>
    </div>
</nav>