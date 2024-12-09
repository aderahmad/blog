<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $this->authorize('admin');
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories',
        ]);

        Category::create($validationData);
        return redirect()->route('view.categories')->with('success', 'New Categories has been added');


    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
        ];


        if($request->slug != $category->slug ) {
            $rules['slug'] = 'required|unique:categories';
        }

        $validationData = $request->validate($rules);

        category::where('id', $category->id)
            ->update($validationData);
        return redirect()->route('view.categories')->with('success', 'cat has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect()->route('view.categories')->with('success', 'Category delete');
    }

    public function formEdit(Category $category) {
        return view('dashboard.categories.edit',[
            'category' => $category,
        ]);
    }

    public function delete(Category $category){
        $post = Post::where('category_id', $category->id)->get();
        foreach($post as $row) {
            if($row->image) {
                Storage::delete($row->image);
            }
        }
        Post::where('category_id', $category->id)->delete();
        Category::where('id',$category->id)->delete();
        return redirect()->route('view.categories')->with('success', 'Category delete');
    }

    public function prosesUpdate(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
        ];


        if($request->slug != $category->slug ) {
            $rules['slug'] = 'required|unique:categories';
        }

        $validationData = $request->validate($rules);

        category::where('id', $category->id)
            ->update($validationData);
        return redirect()->route('view.categories')->with('success', 'category has been updated');
    }
}
