<nav class="navbar p-fixed navbar-dark bg-dark"> 
    <div class="container">
        <a href="/" class="navbar-brand">MPSS</a>
        <div class="d-flex">
            <a href="/" class="nav-link text-white">Blogs</a>
            
            <a href="/admin/blogs/create" class="nav-link text-white">Create Blog</a>

            @guest
            <a href="/register" class="nav-link text-white">Register</a>
            <a href="/login" class="nav-link text-white">Login</a>
            @else
            <a href="" class="nav-link text-white">Welcome {{auth()->user()->name}}</a>
            @endguest

            @auth
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