<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('home')
            ->with('posts', Post::all())
            ->with('categories', Category::all())
            ->with('users', User::all())
            ->with('trashed', $trashed);
    }
}
