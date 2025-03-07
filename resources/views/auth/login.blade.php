<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <h3 class="text-primary text-center my-2 text-2xl">Login form</h3>
                <div class="card p-4 my-3 shadow-sm">
                    <form method="POST">
                        @csrf
                        <div class="mb-3">
                            <label
                                for="exampleInputEmail1"
                                class="form-label"
                            >Email</label>
                            <input
                            required
                            name="email"
                                type="email"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                value="{{old('email')}}"
                            >
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            
                        </div>
                        <div class="mb-3">
                            <label
                                for="exampleInputPassword1"
                                class="form-label"
                            >Password</label>
                            <input
                                required
                                name="password"
                                type="password"
                                class="form-control"
                                id="exampleInputPassword1"
                            >
                            @error('password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <button
                            type="submit"
                            class="btn btn-primary mt-3 px-5"
                        >Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>