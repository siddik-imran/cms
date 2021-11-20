<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersControler extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    public function makeAdmin(User $user)
    {
        //dd($user->toArray());
        $user->role = 'admin';
        $user->save();

        session()->flash('success', 'User role change successfully');
        return redirect(route('users.index'));
    }

    public function editProfile()
    {
        return view('users.edit')->with('user', auth()->user());
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'about' => 'required'
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'about' => $request->about,
        ]);

        session()->flash('success', 'Profile updated successfully');
        return redirect()->back();
    }
}
