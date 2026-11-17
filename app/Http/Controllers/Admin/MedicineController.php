<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\MedCategory;
use App\Models\Medicine;

class MedicineController extends Controller
{
     public function index()
    {
        $medicines = Medicine::get();
        $categories = MedCategory::all();
        return view('admin.medicines.index', compact('medicines', 'categories'));
    }


    public function create()
    {
        $categories = MedCategory::all();
        return view('admin.medicines.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'trade_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:20',
            'description' => 'nullable|string',
            'manufacturer' => 'nullable|string|max:255',
            'med_category_id' => 'nullable|exists:med_categories,id',
        ]);

        Medicine::create($request->all());

        return redirect()->route('medicines.index')->with('success', 'Medicine created successfully.');
    }


    public function show(Medicine $medicine)
    {
        return view('admin.medicines.show', compact('medicine'));
    }


    public function edit(Medicine $medicine)
    {
        $categories = MedCategory::all();
        return view('admin.medicines.edit', compact('medicine', 'categories'));
    }


    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'trade_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:20',
            'description' => 'nullable|string',
            'manufacturer' => 'nullable|string|max:255',
            'med_category_id' => 'nullable|exists:med_categories,id',
        ]);

        $medicine->update($request->all());

        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
    }


    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Medicine deleted successfully.');
    }


}
