<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogManagerController extends Controller
{
    public function blogList()
    {
        $blogs = Blog::latest()->get(); // Fetch all blogs ordered by newest first
        return view('blogs.list', compact('blogs'));
    }


    public function blogView($slug)
    {
        $blog = Blog::where('slug', $slug)->first(); // Fetch all blogs ordered by newest first
        return view('blogs.view', compact('blog'));
    }
}
