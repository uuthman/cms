<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Tag;


class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest $request
     * @return void
      */
    public function store(CreatePostRequest $request)
    {
        $image = $request->image->store('posts');

        $post = Post::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'image' => $image,
                'published_at' => $request->published_at,
                'category_id' => $request->category_id
            ]
        );

        if ($request->tags){
            $post->tags()->attach($request->tags);
        }

        session()->flash('success','Post Created Successfully');
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
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return void
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        $data = $request->only(['title','description','published_at','content','category_id']);

        //check if new image is uploaded
        if ($request->hasFile('image')){
            $image = $request->image->store('posts');
            //delete old image
            $post->deleteImage();
            $data['image'] = $image;
        }

        if ($request->tags){
            $post->tags()->sync($request->tags);
        }

        //update attribute
        $post->update($data);

        session()->flash('success','Post updated successfully');

        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        if ($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
        }else{
            $post->delete();
        }
        session()->flash('success','Post Trashed Successfully');
        return redirect(route('posts.index'));
    }

    public function trashed(){
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts',$trashed);
    }

    public function restore($id){

        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        session()->flash('success','Post Restored Successfully');
        return redirect()->back();
    }
}
