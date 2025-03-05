<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create(){
        return view('auth.create');
    }
    public function store(){
        $formData = request()->validate([
            'name'=>['required','max:255','min:3'],
            'username'=>['required','max:255','min:3',Rule::unique('users','username')],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>'required|min:6'
        ]);//if failed, redirect to /register
        //['name'=>'mgmg','username'=>'mgmg']

        $user = User::create($formData);
        auth()->login($user);

        return redirect('/login');
    }

    public function login(){
        return view('auth.login');
    }

    public function post_login(){
        $formData = request()->validate([
            'email' => ['required','email',Rule::exists('users','email')],
            'password' => ['required', 'min:3']
        ],
    [
        'email.required' => 'Need email',
        'password.required' => 'Need password'
         ]);
    //if user credentials correct -> redirect home
    if (auth()->attempt($formData)){
        if(auth()->user()->is_admin){
            return redirect('/admin/blogs');
        }
        else{
            return redirect('/')->with('success','Login successfully');
        }
        
    }
    //if user credentials fail -> redirect back to form with error
    else{
        return redirect()->back()->withErrors([
            'email' => 'User credential needs.'
        ]);
    }
    }

    public function logout(){
        auth()->logout();
        return redirect('/home')->with('success', 'Good bye');
    }
}
