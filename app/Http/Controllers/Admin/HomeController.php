<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    //
    public function index () {
        $post = Post::all()->last();
        return view('admin.home', compact('post'));
    }}
