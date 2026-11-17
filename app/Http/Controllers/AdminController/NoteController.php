<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('author_id', Auth::id())->get();
        return view('admin.notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($request->id) {
            $note = Note::find($request->id);
            if ($note->author_id !== Auth::id()) {
                abort(403);
            }
            $note->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        } else {
            Note::create([
                'title' => $request->title,
                'description' => $request->description,
                'author_id' => Auth::id(),
            ]);
        }

        return redirect()->route('notes.index')->with('success', 'Note saved successfully.');
    }

    public function show(Note $note)
    {
        if ($note->author_id !== Auth::id()) {
            abort(403);
        }

        return response()->json($note);
    }

    public function update(Request $request, Note $note)
    {
        if ($note->author_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $note->update($request->all());

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    public function destroy(Note $note)
    {
        if ($note->author_id !== Auth::id()) {
            abort(403);
        }

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}
