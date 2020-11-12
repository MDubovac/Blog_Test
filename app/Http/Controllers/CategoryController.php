<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    // Index
    public function index(){
        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);
    }

    //Create
    public function create(){
        return view('categories.create');
    }

    // Store
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'string|max:191|unique:categories'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect(route('categories.index'));
    }
    
    // Edit
    public function edit(Category $category){
        return view('categories.create')->with('category', $category);
    }

    // Update
    public function update(Request $request, Category $category){
        $this->validate($request, [
            'name' => 'string|max:191|unique:categories'
        ]);

        $category->update([
            'name' => $request->name
        ]);
            
        return redirect(route('categories.index'));
    }

    // Delete
    public function destroy(Category $category){
        $category->delete();
        return redirect(route('categories.index'));

    }
}
