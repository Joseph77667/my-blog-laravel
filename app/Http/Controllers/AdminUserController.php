<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUserController
{
    public function index(){
        return view('admin.users.index',[
            'users'=>User::latest()->paginate(6)
        ]);
    }

    public function create()
    {
        if(auth()->guest() || !auth()->user()->is_admin){
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

    public function edit(User $user){
        return view('admin.users.edit',[
            'user'=> $user,
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

    public function destroy(User $user){
        $user->delete();
        return back();
    }
}
