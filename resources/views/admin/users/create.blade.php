<x-admin-layout>
    <h3 class="my-3 text-center">User create form</h3>
    <div class="col-md-8 mx-auto">
        <x-card-wrapper>
            <form
                action="/admin/user/store"
                method="POST"
            >
                @csrf
                <div class="mb-3">
                    <label
                        for="name"
                        class="form-label"
                    >Name</label>
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        name="name"
                        value="{{old('name')}}"
                    >
                    <x-error name="name" />
                </div>
                <div class="mb-3">
                    <label
                        for="email"
                        class="form-label"
                    >Email</label>
                    <input
                        id="email"
                        required
                        type="email"
                        class="form-control"
                        name="email"
                        value="{{old('email')}}"
                    >
                    <x-error name="email" />
                </div>
                <div class="mb-3">
                    <label
                        for="password"
                        class="form-label"
                    >Password</label>
                    <input
                        id="password"
                        required
                        type="password"
                        class="form-control"
                        name="password"
                        value="{{old('password')}}"
                    >
                    <x-error name="password" />
                </div>
                <div class="d-flex justify-content-start mt-3">
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >Submit</button>
                </div>
            </form>
        </x-card-wrapper>
    </div>
</x-admin-layout>