<x-layout>
    <!-- single blog section -->
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto text-center min-h-[600px]">
                <x-card-wrapper>
                    <img 
                    src="{{ asset('storage/' . $blog->thumbnail) }}"
                    class="object-contain w-full h-[400px]" alt="..." 
                    />
                    
                    <h3 class="my-2 font-semibold text-blue-600">{{$blog->title}}</h3>
                    <div>
                        <div>Author - <a href="/?username={{$blog->author->name}}">{{$blog->author->name}}</a></div>
                        <div class="badge bg-primary">{{$blog->category->name}}</div>
                        <div class="text-secondary">{{$blog->created_at->diffForHumans()}}</div>
                        <div class="text-secondary mt-1">
                            <form action="/blogs/{{$blog->slug}}/subscription" method="post">
                                @csrf
                                @auth
                                    @if (auth()->user()->isSubscribed($blog))
                                        <button type="submit" 
                                        class="btn btn-danger">Unsubscribe</button>
                                    @else
                                        <button type="submit" 
                                        class="btn btn-warning">Subscribe</button>
                                    @endif
                                @endauth
                            </form>
                        </div>
                    </div>
                    <p class="lh-md mt-3">
                        {{$blog->body}}
                    </p>
                </x-card-wrapper>
            </div>
        </div>
    </div>

    <section class="container">
        <div class="col-md-8 mx-auto">
            @auth
                <x-comment-form :blog="$blog" />
            @else
                <p class="text-center">Please <a href="/login" class="text-blue-500 underline">login</a> to participate in this discussion.</p>
            @endauth
        </div>
    </section>

    @if ($blog->comments->count())
        <x-comments :comments="$blog->comments()->latest()->paginate(3)" />
    @endif
    <x-blogs_you_may_like_section :randomBlogs="$randomBlogs" />
</x-layout>
