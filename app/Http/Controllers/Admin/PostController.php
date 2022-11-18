<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('posts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id'=> 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'tags' => 'exists:tags,id'
        ]);
        $data = $request->all();
        $data['slug'] = $this->getSlug($data['title']);
        if(!empty($data['image'])) {
           $imagePath =  Storage::put('uploads', $data['image']);
            $data['image'] = asset('storage/' . $imagePath)  ;
        }
        $newPost = new Post();
        $newPost->fill($data);
        $newPost->save();
        if(!empty($data['tags'])) {
            $newPost->tags()->attach($data['tags']);
        }
        return redirect()->route('admin.posts.show', $newPost->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //

        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
       $request->validate([
           'title' => 'required|max:255',
           'content' => 'required',
           'image' => 'nullable|image',
           'category_id'=> 'nullable|exists:categories,id',
           'tags' => 'exists:tags,id'
       ]);
       $data = $request->all();
       $slug = Str::slug($data['title'], '-');

       if($data['title']!= $post->title) {
        $slug = $this->getSlug($data['title']);
       }
       if(!empty($data['image'])) {
        $data['image'] = asset('images/' . $this->uploadImage($data['image'])) ;
    }

        $data['slug'] = $slug;
        $post->update($data);
        if(!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        $post->tags()->detach();
        return redirect()->route('admin.posts.index');
    }

    private function getSlug($title) {
        $slug = Str::slug($title, '-');
        $slugBase = $slug;
        $postWithSlug = Post::where('slug', $slug)->first();
        $counter = 1;
        while($postWithSlug) {
            $slug = $slugBase . '-' . $counter;
            $counter++;
            $postWithSlug = Post::where('slug', $slug)->first();
        }
        return $slug;
    }
}
