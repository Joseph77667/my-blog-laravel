<x-layout>
    <h1 class="text-center mb-2">Create Form</h1>
    <div class="d-flex justify-content-center align-items-center w-300">
        <form action="/" method="post" class="shadow p-4 mx-20 mb-3 rounded bg-light">
            @csrf
            <div class="form-group mb-2">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="form-group mb-2">
                <label for="intro">Intro</label>
                <input type="text" name="intro" class="form-control" id="intro" placeholder="Intro">
            </div>
            <div class="form-group mb-2">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
            </div>
            <div class="form-group mb-2">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" id="body" cols="30" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-layout>