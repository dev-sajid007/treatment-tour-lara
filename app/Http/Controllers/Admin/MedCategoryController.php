<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\MedCategory;

class MedCategoryController extends Controller
{
    public function index()
    {
        $categories = MedCategory::latest()->get();
        return view('admin.med_categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.med_categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);



        $category = new MedCategory();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();


        return redirect()->back()->with('success', 'Category created successfully.');
    }



    public function show($id)
    {
        return view('admin.med_categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.med_categories.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = MedCategory::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save;
        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = MedCategory::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
