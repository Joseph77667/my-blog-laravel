<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto my-2">
                <h3 class="text-primary text-center my-2 text-2xl">Edit Avatar</h3>
                <div class="card p-4 my-3 shadow-sm">
                    <form action="/user/{{ auth()->user()->id }}/update-avatar" 
                        method="POST" 
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 mx-auto w-full bg-red-300">
                            <img src="{{ asset( auth()->user()->avatar) }}" 
                                alt="" 
                                width="300" height="300"
                                class="rounded-full object-cover mx-auto border-4 border-gray-300">
                        </div>
                        <h2>Name : <span class="text-primary">{{ auth()->user()->name }}</span></h2>
                        <div class="my-3">
                            <label for="avatar" class="form-label">Select New Avatar:</label>
                            <input
                                required
                                name="avatar"
                                type="file"
                                class="form-control"
                                id="avatar"
                            >
                        </div>
                        <button
                            type="submit"
                            class="btn btn-primary my-3 px-5 w-full"
                        >Update Avatar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>