<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminUserController
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::latest()->paginate(6)
        ]);
    }

    public function editAvatar(User $user){
        return view('user.edit',[
            'user'=> $user,
        ]);
    }

    public function updateAvatar(Request $request, $id)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = User::findOrFail($id);

        // Store the uploaded file
        if ($request->hasFile('avatar')) {
            // Delete the old avatar if it exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar); 
            }
    
            // Store the new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => "storage/$path"]); 
        }

        return redirect()->route('user.edit', $id)->with('success', 'Avatar updated successfully!');
    }
    public function create()
    {
        if (auth()->guest() || !auth()->user()->is_admin) {
            abort(403);
        }

        return view('admin.users.create');
    }

    public function store()
    {
        $formData = request()->validate([
            'name' => ['required', 'max:225'],
            'email' => 'required|email',
        ]);

        $formData['user_id'] = auth()->user()->id;

        User::create($formData);

        return redirect('/admin/user');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }


    public function update(User $user)
    {

        $formData = request()->validate([
            'name' => ['required', 'max:225'],
            'email' => ['required', 'email']
        ]);

        $formData['user_id'] = auth()->id();

        $user->update($formData);

        return redirect('/admin/users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
