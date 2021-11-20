<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only(['store', 'create']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::with('category')->get();
        //dd($posts->toArray());
        return view('posts.index')->with('posts', Post::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
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
            'image' => 'required|image|max:2048',
            'category' => 'required'
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
        $post->category_id = $request->category;
        $post->user_id = auth()->user()->id;

        $post->save();

        if($request->tags){
            $post->tags()->attach($request->tags);
        }

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
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'published_at' => 'required',
            'category' => 'required'
        ]);

        $data = $request->only(['title', 'description', 'content', 'published_at', 'category']);

        $file = '';
        $upload_path = public_path('uploads');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = time()."_".$file->getClientOriginalName();
            $file->move($upload_path, $imageName);

            $post->deleteImage();

            $data['image'] = $imageName;

        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('success', 'Post updated successfully');
        return redirect(route('posts.index'));

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
            $post->deleteImage();
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

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        session()->flash('success', 'Post restored successfully');
        return redirect()->back();
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
