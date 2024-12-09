<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('pengguna_id', Auth::user()->id)->get();
        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $validationData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        if($request->file('image')) {
            $validationData['image'] = $request->file('image')->store('post-image');
        }

        $validationData['pengguna_id'] = Auth::user()->id;
        $validationData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        Post::create($validationData);
        return redirect()->route('view.post')->with('success', 'New post has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $posts = $post;
        return view('dashboard.posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('dashboard.posts.edit', [
            'post' => $post
        ] ,compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];


        if($request->slug != $post->slug ) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validationData = $request->validate($rules);

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validationData['image'] = $request->file('image')->store('post-image');
        }

        $validationData['pengguna_id'] = Auth::user()->id;
        $validationData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        Post::where('id', $post->id)
            ->update($validationData);
        return redirect()->route('view.post')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->image) {
            Storage::delete($post->image);
        }
        Post::destroy($post->id);
        return redirect()->route('view.post')->with('success', 'Post delete');
    }
}
