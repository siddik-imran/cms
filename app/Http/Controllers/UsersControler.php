<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;

class UsersControler extends Controller
{
    public function index()
    {
        //dd(User::all()->toArray());
        return view('users.index')->with('users', User::all());
    }

    public function makeAdmin(User $user)
    {
        //dd($user->toArray());
        $user->role = 'admin';
        $user->save();

        Session::flash('success', 'User role change successfully');
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
            'about' => 'required',
            'image' => 'image'
        ]);

        //dd($request->all());

        $user = auth()->user();

        $file = '';
        $upload_path = public_path('users');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move($upload_path, $imageName);

            $user->update([
                'name' => $request->name,
                'about' => $request->about,
                'password' => $request->password,
                'image' => $imageName
            ]);
        }
        else{
            $user->update([
                'name' => $request->name,
                'about' => $request->about,
                'password' => $request->password
            ]);
        }

        Session::flash('success', 'Profile updated successfully');
        return redirect()->back();
    }
}
