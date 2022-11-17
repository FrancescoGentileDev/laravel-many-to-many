<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'title' => 'Tags',
            'subtitle' => 'List of tags',
            'elem' => Tag::all(),
            'create' => [
                'route' => route('admin.tags.store'),
                'label' => 'Create new tag',
            ],
            'table' => [
                'head' => [
                    'Name',
                    'Actions',
                ],
                'body' => [
                    'name' => 'name',
                    'actions' => [
                        'show' => [
                            'route' => 'admin.tags.show',
                            'label' => 'View',
                        ],
                        'edit' => [
                            'route' => 'admin.tags.edit',
                            'label' => 'Edit',
                        ],
                        'delete' => [
                            'route' => 'admin.tags.destroy',
                            'label' => 'Delete',
                        ],
                    ],
                ],
            ],
        ];
        return view('layouts.indexInTab', compact('data'));
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
        $request->validate([
            'name' => 'required|max:255|unique:tags,name',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['name'], '-');
        $newTag = new Tag();
        $newTag->fill($data);
        $newTag->save();
        return redirect()->route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $data = [
            'title' => 'tag: ' . $tag->name,
            'subtitle' => 'List of ' . $tag->name . ' posts',
            'elem' => $tag->posts,
            'table' => [
                'head' => [
                    'Category',
                    'title',
                    'Actions',
                ],
                'body' => [
                    'name' => 'category',
                    'actions' => [
                        'show' => [
                            'route' => 'admin.posts.show',
                            'label' => 'View',
                        ],
                        'edit' => [
                            'route' => 'admin.posts.edit',
                            'label' => 'Edit',
                        ],
                        'delete' => [
                            'route' => 'admin.posts.destroy',
                            'label' => 'Delete',
                        ],
                    ],
                ],
            ],
        ];
        if ($tag) {
            return view('layouts.indexInTab', compact('data'));
        }

        return redirect()->route('admin.tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
        $data = [
            'title' => 'Edit tag',
            'subtitle' => 'Edit tag',
            'elem' => $tag,
            'form' => [
                'route' => route('admin.tags.update', $tag->id),
                'method' => 'PUT',
                'fields' => [
                    'name' => [
                        'type' => 'text',
                        'label' => 'name',
                        'value' => $tag->name,
                    ],
                ],
                'submit' => [
                    'label' => 'Edit tag',
                ],
            ],
        ];
        return view('layouts.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
        $request->validate([
            'name' => 'required|max:255|unique:tags,name,',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['name'], '-');
        $tag->update($data);
        return redirect()->route('admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('admin.tags.index');
    }
}
