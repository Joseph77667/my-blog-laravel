<nav class="navbar p-fixed bg-slate-700"> 
    <div class="container flex items-center align-middle">
        <a href="/" class="navbar-brand text-white">MyLogo</a>
        <div class="d-flex gap-x-5">
            <a href="/" class="nav-link {{request()->is('/') ? 'text-blue-500' : 'text-white'}}">Blogs</a>
            @guest
            <a href="/register" 
            class="nav-link 
            {{request()->is('register') ? 'text-blue-500' : 'text-white'}}">Register</a>
            <a href="/login" class="nav-link 
            {{request()->is('login') ? 'text-blue-500' : 'text-white'}}">Login</a>           
            @endguest

            @auth
            @can('admin')
            <a href="/admin/blogs"
             class="nav-link 
             {{request()->is('admin/blogs') ? 'text-blue-500' : 'text-white'}}">Dashboard</a>
            @endcan
            <div>
                <a class="flex justify-between items-center px-3 bg-slate-200">
                    <img 
                    src="{{auth()->user()->avatar}}" 
                    width="44"
                    height="50"
                    class="rounded-full"
                    alt="">
    
                    <h3>{{auth()->user()->name}}</h3>
                </a>
            </div>
            <form action="/logout" method="POST">
                @csrf
                <button href="" 
                type="submit"
                class="nav-link text-white btn btn-link">
                Logout</button>
            </form>
            @endauth
        </div>
    </div>
</nav>