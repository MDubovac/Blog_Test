<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    public function makeAdmin(User $user){
        $user->role = 'admin';
        $user->save();

        session()->flash('s', 'User has been made admin successfully.');
        return redirect(route('users.index'));
    }
}
