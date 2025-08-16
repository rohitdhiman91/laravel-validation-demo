<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    // Show form
    public function create()
    {
        return view('register');
    }

    // Validate & save user
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return redirect('/register')->with('success', 'User registered successfully!');
    }
}
