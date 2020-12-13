<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /* Constructor */
    public function __construct(){
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'string|required|unique:posts',
            'description' => 'string|required',
            'body' => 'string|required',
            'image' => 'image|required',
            'category_id' => 'required'
        ]);

        $image = $request->image->store('posts');

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'image' => $image,
            'category_id' => $request->category_id
        ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        session()->flash('s', 'Post Created Successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("posts.show")->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("posts.create")->with('post', $post)->with('categories', $categories)->with('tags', $tags);
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
        $this->validate($request, [
            'title' => ['required', Rule::unique('posts', 'title')->ignore($post->id)],
            'description' => 'string|required',
            'body' => 'string|required',
            'category_id' => 'required'
        ]);

        $data = $request->only(['title', 'description', 'body', 'category_id']);

        if($request->hasFile('image')){
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        
        // Sync The Tags
        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('s', 'Post Updated Successfully.');
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
        $post = Post::withTrashed()->where('id', $id)->first();
        if($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
        }else{
            $post->delete();
        } 

        session()->flash('s', 'Post Deleted Successfully.');
        return redirect(route('posts.index'));
    }

    /** 
     * Soft Deletes 
     * Trashed Function
     * Get all the trashed posts
     * Display them on index page in posts
     **/
    public function trashed(){
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);
    }

    /** 
     * Soft Deletes 
     * Restore Function
     * Get the trashed post we wish to restore
     * Restore The Actual Post
     **/
     public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        
        session()->flash('s', 'Post Restored Successfully.');
        return redirect()->back();
    }


}
