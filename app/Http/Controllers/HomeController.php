<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Pengguna;

class HomeController extends Controller
{
    public function home() {
        return view('home', [
            "title" => "Home",
        ]);
    }
    public function about() {
        return view('about', [
            "title" => "About",
            "name" => "Ade Rahmad",
            "email" => "melody.ade21@gmail.com",
            "image" => "ade.png",
        ]);
    }

    
    public function posts() {
        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = 'in '.$category->name;
        }
        if(request('author')) {
            $author = Pengguna::firstWhere('username', request('author'));
            $title = 'in '.$author->name;
        }

        $posts = Post::latest()->filter(request(['search', 'category', 'author']));
        
        return view('posts', [
            "title" => "All Posts ". $title,
            "posts" => $posts->paginate(7)->withQueryString(),
        ]);
    }

    public function post($slug) {
    $post = Post::where('slug', $slug)->first(); 
        return view('post', [
            "title" => "Single Post"
        ], compact('post'));
    }

    public function categories() {
        return view('categories', [
            'title' => 'Post Categories',
            'categories' => Category::all(),
        ]);
    } 

    public function authors(Pengguna $pengguna) {
        return view('posts', [
            'title' => "Post By Author : $pengguna->name",
            'posts' => $pengguna->posts->load('category', 'pengguna'),
        ]);
    }
}
 