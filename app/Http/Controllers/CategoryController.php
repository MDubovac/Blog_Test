<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Validation\Rule;

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

        session()->flash('s', 'Category Created Successfully.');
        return redirect(route('categories.index'));
    }
    
    // Edit
    public function edit(Category $category){
        return view('categories.create')->with('category', $category);
    }

    // Update
    public function update(Request $request, Category $category){
        $this->validate($request, [
            'name' => ['required', Rule::unique('categories', 'name')->ignore($category->id)]
        ]);

        $category->update([
            'name' => $request->name
        ]);
            
        session()->flash('s', 'Category Updated Successfully.');
        return redirect(route('categories.index'));
    }

    // Delete
    public function destroy(Category $category){
        $category->delete();

        session()->flash('s', 'Category Deleted Successfully.');
        return redirect(route('categories.index'));

    }
}
