<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast;

class PodcastController extends Controller
{
     public function index()
    {
        $podcasts = Podcast::latest()->get();
        return view('podcasts.index', compact('podcasts'));
    }


    public function create()
    {
        return view('podcasts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|string|max:255',
        ]);

        $podcast = new Podcast();
        $podcast->video = $request->video;
        $podcast->save();

        return redirect()->route('podcasts.index')->with('success', 'podcast created successfully!');
    }


    public function edit($id)
    {
        $podcast = Podcast::findOrFail($id);
        return view('podcasts.edit', compact('podcast'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'video' => 'required|string|max:255',
        ]);

        $podcast = Podcast::findOrFail($id);
        $podcast->video = $request->video;
        $podcast->save();

        return redirect()->route('podcasts.index')->with('success', 'podcast updated successfully!');
    }


    public function destroy($id)
    {
        $podcast = Podcast::findOrFail($id);
        $podcast->delete();

        return redirect()->route('podcasts.index')->with('success', 'podcast deleted successfully!');
    }
}
