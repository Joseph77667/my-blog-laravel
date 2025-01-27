<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create(){
        return view('register.create');
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

        return redirect('/')->with('success', 'Welcome Dear, '.$user->name);
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
    if (auth()->attempt($formData)){
        return redirect('/')->with('success','Login successfully');
    }
    else{
        return redirect()->back()->withErrors([
            'email' => 'User credential needs.'
        ]);
    }
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success', 'Good bye');

    }
}
