<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageGeneration;
use Illuminate\Support\Str;

class PageGenerationController extends Controller
{
    public function index()
    {
        $pageGenerations = PageGeneration::all();
        return view('page_generations.index', compact('pageGenerations'));
    }


    public function create()
    {
        return view('page_generations.create');
    }

   
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'placement' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'page_name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable',
        ]);

       $slug = Str::slug($request->slug);
       
       $page = new PageGeneration();
       $page->placement = $request->placement;
       $page->slug = $slug;
       $page->page_name = $request->page_name;
       $page->title = $request->title;
       $page->description = $request->description;
       $page->save();

        // Redirect to the index page with success message
        return redirect()->route('page_generations.index')->with('success', 'Page Generation created successfully!');
    }

    
    public function view($slug)
    {
        $page = PageGeneration::where('slug', $slug)->first();
        return view('page_generations.view', compact('page'));
    }

    public function edit($id)
    {
        $pageGeneration = PageGeneration::findOrFail($id);
        return view('page_generations.edit', compact('pageGeneration'));
    }

    
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'placement' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'page_name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable',
        ]);
        
       $slug = Str::slug($request->slug);
        // Find the page generation and update it
       $page = PageGeneration::findOrFail($id);
       $page->placement = $request->placement;
       $page->slug = $slug;
       $page->page_name = $request->page_name;
       $page->title = $request->title;
       $page->description = $request->description;
       $page->save();

        // Redirect with success message
        return redirect()->route('page_generations.index')->with('success', 'Page Generation updated successfully!');
    }

    // Delete a page generation
    public function destroy($id)
    {
        // Find and delete the page generation
        $pageGeneration = PageGeneration::findOrFail($id);
        $pageGeneration->delete();

        // Redirect with success message
        return redirect()->route('page_generations.index')->with('success', 'Page Generation deleted successfully!');
    }
}
