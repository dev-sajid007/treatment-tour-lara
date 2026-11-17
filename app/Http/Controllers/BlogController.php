<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
      $blogs = Blog::all();
      return view('blogs.index', compact('blogs'));
    }


    public function create()
    {

       return view('blogs.create'); 
    }


    public function store(Request $request)
    {
       
        $request->validate([
            'title'       => 'required|max:255',
            'content' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    
        ]);

        

        if ($request->hasFile('image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileBlogPhoto = $filename . '_' . time() . '.' . $extension;
            // Define upload path
            $uploadPath = public_path('uploads/blog');
            
            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Move the uploaded file
            $request->file('image')->move($uploadPath, $fileBlogPhoto);
        } else {
            $fileBlogPhoto = 'no.png';
        }

        // Create new blog entry

        $blog              = new Blog();
        $blog->title       = $request->title;
        $blog->description = $request->content;
        $blog->image       = 'uploads/blog/' . $fileBlogPhoto;

        // Generate a unique slug
        $slug = Str::slug($request->title);

        // Ensure the slug is unique
        $existingSlug = Blog::where('slug', $slug)->first();
        $count = 1;
        while ($existingSlug) {
            $slug = Str::slug($request->title) . '-' . $count;
            $existingSlug = Blog::where('slug', $slug)->first();
            $count++;
        }

        $blog->slug = $slug;
        $blog->save();

  

        return redirect()->back()->with('success', 'You have added a new blog successfully');
    }



    public function show($slug)
    {
        
        $blog       = Blog::where('slug', $slug)->firstOrFail();
        return view('blogs.show', compact('blog'));
    }


    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blogs.edit', compact('blog'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'title'   => 'required|max:255',
        'content' => 'required',
        'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $blog = Blog::findOrFail($id);
    
    // Update basic fields
    $blog->title = $request->title;
    $blog->description = $request->content;

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($blog->image && file_exists(public_path($blog->image)) && $blog->image !== 'uploads/blog/no.png') {
            unlink(public_path($blog->image));
        }

        // Get new filename
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileBlogPhoto = $filename . '_' . time() . '.' . $extension;

        // Define upload path
        $uploadPath = public_path('uploads/blog');

        // Ensure the directory exists
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Move uploaded file
        $request->file('image')->move($uploadPath, $fileBlogPhoto);

        // Update image path in the database
        $blog->image = 'uploads/blog/' . $fileBlogPhoto;
    }

    // Generate a unique slug if the title has changed
    if ($blog->title !== $request->title) {
        $slug = Str::slug($request->title);
        $existingSlug = Blog::where('slug', $slug)->where('id', '!=', $id)->first();
        $count = 1;

        while ($existingSlug) {
            $slug = Str::slug($request->title) . '-' . $count;
            $existingSlug = Blog::where('slug', $slug)->where('id', '!=', $id)->first();
            $count++;
        }

        $blog->slug = $slug;
    }

    $blog->save();

    return redirect()->back()->with('success', 'Blog updated successfully');
}




    public function destroy($id)
    {
        // Find the blog post
        $blog = Blog::findOrFail($id);
        
        // Define the image path
        $uploadPath = public_path('uploads/blog');

        // Delete the image if it exists and is not the default 'no.png'
        if ($blog->photo && $blog->photo !== 'no.png' && file_exists($uploadPath . '/' . $blog->photo)) {
            unlink($uploadPath . '/' . $blog->photo);
        }

        // Delete the blog post
        $blog->delete();

        return redirect()->back()->with('success', 'Blog deleted successfully');
    }

}
