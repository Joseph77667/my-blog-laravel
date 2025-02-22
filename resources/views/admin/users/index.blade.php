<x-admin-layout>
    <div class="w-full flex justify-between items-center align-middle mt-1">
        <h3 class="text-3xl mt-2">All Users</h3>
        <a href="/admin/users/create" class="text-2xl font-semibold text-blue-600">Create</a>
    </div>
    <x-card-wrapper>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th
                        scope="col"
                        colspan="2"
                    >Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td><a 
                        href="/users/{{$user->slug}}"
                        target="_blank">
                        {{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td><a
                            href="/admin/users/{{$user->name}}/edit"
                            class="btn btn-warning"
                        >Edit</a></td>
                    <td>
                        <form
                            action="/admin/users/{{$user->name}}/delete"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="btn btn-danger"
                            >delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </x-card-wrapper>
</x-admin-layout>