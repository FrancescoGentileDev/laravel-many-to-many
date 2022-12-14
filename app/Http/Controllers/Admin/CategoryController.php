<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;
class CategoryController extends Controller
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
            'title' => 'Categories',
            'subtitle' => 'List of categories',
            'elem' => Category::all(),
            'create' => [
                'route' => route('admin.categories.store'),
                'label' => 'Create new category',
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
                            'route' => 'admin.categories.show',
                            'label' => 'View',
                        ],
                        'edit' => [
                            'route' => 'admin.categories.edit',
                            'label' => 'Edit',
                        ],
                        'delete' => [
                            'route' => 'admin.categories.destroy',
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
        return redirect()->route('admin.categories.index');

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
            'name' => 'required|max:255|not_in:exists:categories,name',
        ],
        [
            'name.not_in' => 'Categories just exist'
        ]);
        $data = $request->all();

        $newCategory = new Category();
        $data['slug'] = Str::slug($data['name'], '-');

        $newCategory->fill($data);
        $newCategory->save();
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $category = Category::where('slug', $slug)->first();
        $data = [
            'title' => 'category: ' . $category->name,
            'subtitle' => 'List of ' . $category->name . ' posts',
            'elem' => $category->posts,
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
        if ($category) {
            return view('layouts.indexInTab', compact('data'));
        }

        return redirect()->route('admin.tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        $data = [
            'title' => 'Edit category',
            'subtitle' => 'Edit category',
            'elem' => $category,
            'form' => [
                'route' => route('admin.categories.update', $category->id),
                'method' => 'PUT',
                'fields' => [
                    'name' => [
                        'type' => 'text',
                        'label' => 'name',
                        'value' => $category->name,
                    ],
                ],
                'submit' => [
                    'label' => 'Edit category',
                ],
            ],
        ];
        return view('layouts.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['name'], '-');
        $category->update($data);
        return redirect()->route('admin.categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories.index');

    }
}
