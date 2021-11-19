<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:posts',
            'description' => 'required',
            'content' => 'required',
            'published_at' => 'required',
            'image' => 'image|max:2048'
        ]);

        $file = '';
        $upload_path = public_path('uploads');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move($upload_path, $imageName);
        }

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->published_at = $request->published_at;
        $post->image = $imageName;

        $post->save();

        session()->flash('success', 'Post created successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if($post->trashed()){
            $image_path = public_path("uploads/{$post->image}");

            if (isset($image_path)) {
                unlink($image_path);
            }
            $post->forceDelete();
        }
        else {
            $post->delete();
        }

        session()->flash('success', 'Post deleted successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Displying all the trashed posts.
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts', $trashed);
    }

    // public static function validateData($data)
    // {
    //     //dd('here');
    //     $data = $data->validate($data,[
    //         'name' => 'required|unique:posts',
    //         'description' => 'required',
    //         'content' => 'required',
    //         'image' => 'required'
    //     ]);
    //     return $data;
    // }
}
