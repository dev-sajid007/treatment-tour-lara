<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TreatmentCategory;

class TreatmentCategoryController extends Controller
{
    public function index()
    {
        $categories = TreatmentCategory::all();
        return view('package.treatment_categories.index', compact('categories'));
    }


    public function create()
    {
        return view('package.treatment_categories.create');
    }

 
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:150',
            'description' => 'nullable|string|max:200',
        ]);

        TreatmentCategory::create($request->all());

        return redirect()->route('treatment-categories.index')->with('success', 'Category created successfully.');
    }


    public function show(TreatmentCategory $treatmentCategory)
    {
        return view('package.treatment_categories.show', compact('treatmentCategory'));
    }


    public function edit(TreatmentCategory $treatmentCategory)
    {
        return view('package.treatment_categories.edit', compact('treatmentCategory'));
    }


    public function update(Request $request, TreatmentCategory $treatmentCategory)
    {
        $request->validate([
            'category_name' => 'required|string|max:150',
            'description' => 'nullable|string|max:200',
        ]);

        $treatmentCategory->update($request->all());

        return redirect()->route('treatment-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(TreatmentCategory $treatmentCategory)
    {
        $treatmentCategory->delete();

        return redirect()->route('treatment-categories.index')->with('success', 'Category deleted successfully.');
    }

}
