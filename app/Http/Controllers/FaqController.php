<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
     public function index()
    {
        $faqs = Faq::latest()->get();
        return view('faqs.index', compact('faqs'));
    }


    public function create()
    {
        return view('faqs.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:800',
        ]);

        $faq = new Faq();
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->save();

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully!');
    }


    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('faqs.edit', compact('faq'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:800',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->save();

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully!');
    }


    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully!');
    }
}
