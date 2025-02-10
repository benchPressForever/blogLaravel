<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller{

    public function show(User $user)
    {
        return view('users.show',['user'=>$user]);
    }
}
