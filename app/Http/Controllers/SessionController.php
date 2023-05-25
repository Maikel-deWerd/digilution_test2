<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        //checking on the creds
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        //doing the login
        if (auth()->attempt($attributes))
        {
            session()->regenerate();

            return redirect('/')->with('success', 'Welcome Back!');
        }

        // if the auth fails
        // throw ValidationExceptation::withMessages([
        //     'email' => 'Your provided credentials could not be verified'
        // ]);

        return back()
            ->withInput()
            ->withErrors(['email' => 'Your provided credentials could not be verified']);
    }

    public function destroy()
    {
        //logout
        auth()->logout();
        //goes back to the hoemepage
        return redirect('/')->with('success', 'Goodbye!');
    }
}
