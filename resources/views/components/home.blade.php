<x-layout>
    <div class="container mx-auto px-4">
        <header class="relative flex h-[600px] flex-col md:flex-row items-center justify-between mt-2 py-20 bg-cover bg-center text-white" 
        style="background-image: url('https://platform.vox.com/wp-content/uploads/sites/2/chorus/uploads/chorus_asset/file/18277139/GettyImages_577660404.jpg?quality=90&strip=all&crop=0%2C0%2C100%2C100&w=2400');">
        <div class="md:w-1/2 mx-auto p-8 bg-gray-800 bg-opacity-50 rounded-lg">
            <h1 class="text-5xl font-bold leading-tight">Welcome to My Blog</h1>
            <p class="mt-4 text-lg">
                Discover insights, stories, and ideas that inspire. Join me on this journey of exploration and learning.
            </p>
            <a href="/" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-500 transition">
                View All Blogs
            </a>
        </div>
        {{-- <div class="md:w-1/2 mt-6 md:mt-0">
            <img src="https://livtekindia.com/cdn/shop/files/MipadMediumNavyBlue_Main_900x.jpg?v=1684825625" alt="Blog Illustration" class="w-full h-auto rounded-lg shadow-lg">
        </div> --}}
        </header>
        <section class="my-10 bg-blue-600 p-5">
            <h2 class="text-3xl font-bold text-white text-center pb-2">Benefits of Reading</h2>
            <div class="flex flex-col md:flex-row items-center mt-6">
                <div class="md:w-1/2 p-6">
                    <p class="text-lg text-white ">
                        Reading enhances knowledge, improves vocabulary, and strengthens critical thinking skills. 
                        It provides an escape into different worlds and perspectives, fostering empathy and understanding. 
                        Whether fiction or non-fiction, books can inspire creativity, reduce stress.
                    </p>
                </div>
                <div class="md:w-1/2 mt-6 md:mt-0">
                    <img src="https://nypost.com/wp-content/uploads/sites/2/2020/03/reading-in-bed.jpg?quality=75&strip=all" alt="Reading Benefits" class="w-full h-auto rounded-lg shadow-lg">
                </div>
            </div>
        </section>
        <section class="my-10 bg-yellow-300 p-5">
            <h2 class="text-3xl font-bold text-gray-800">Latest Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($blogs as $blog)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" 
                        class="card-img-top card-img object-cover h-[400px]">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $blog->title }}</h3>
                            <p class="mt-2 text-gray-600">{{ Str::limit($blog->content, 100) }}</p>
                            <a href="/blogs/{{ $blog->slug }}" class="inline-block mt-4 bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-500">
                                Read More
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</x-layout>