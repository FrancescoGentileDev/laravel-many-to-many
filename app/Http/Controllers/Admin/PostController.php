<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Post;
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
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view('admin.posts.edit', compact('post'));
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
           'image' => 'nullable|image'
       ]);
       $data = $request->all();
       $slug = Str::slug($data['title'], '-');

       if($data['title']!= $post->title) {
        $slug = $this->getSlug($data['title']);
       }

        $data['slug'] = $slug;
        $post->update($data);
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
