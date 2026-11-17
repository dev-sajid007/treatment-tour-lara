<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TreatmentPackage;
use App\Models\TreatmentCategory;
use Spatie\Permission\Models\Role;
use App\Models\Country;
use Auth;

class TreatmentPackageController extends Controller
{
      public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('superadmin')) {
            $packages = TreatmentPackage::with(['category', 'country'])->get();
        } else {
            $packages = TreatmentPackage::with(['category', 'country'])
                ->where(function ($query) use ($user) {
                    if ($user->hasRole('hospital')) {
                        $query->where('hospital_id', $user->hospital_id);
                    }

                    if ($user->hasRole('clinic')) {
                        $query->where('clinic_id', $user->clinic_id);
                    }
                })
                ->get();
        }
        return view('package.treatment_packages.index', compact('packages'));
    }

    public function create()
    {
        $categories = TreatmentCategory::all();
        $countries = Country::all();
        return view('package.treatment_packages.create', compact('categories', 'countries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'treatment_category_id' => 'required|exists:treatment_categories,id',
            'country_id' => 'required|exists:countries,id',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();



        $data['hospital_id'] = auth()->user()->hospital_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('treatment_packages'), $imageName);
            $data['image'] = 'treatment_packages/' . $imageName;
        }

        TreatmentPackage::create($data);

        return redirect()->route('treatment-packages.index')->with('success', 'Treatment package created successfully!');
    }


    public function edit($id)
    {
        $package = TreatmentPackage::findOrFail($id);
        $categories = TreatmentCategory::all();
        $countries = Country::all();
        
        return view('package.treatment_packages.edit', compact('package', 'categories', 'countries'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'treatment_category_id' => 'required|exists:treatment_categories,id',
            'country_id' => 'required|exists:countries,id',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $package = TreatmentPackage::findOrFail($id);
        $data = $request->all();

        // Handle image upload and delete the old image
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($package->image && file_exists(public_path($package->image))) {
                unlink(public_path($package->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('treatment_packages'), $imageName);
            $data['image'] = 'treatment_packages/' . $imageName;
        }

        $package->update($data);

        return redirect()->route('treatment-packages.index')->with('success', 'Treatment package updated successfully!');
    }


    public function destroy($id)
    {
        $package = TreatmentPackage::findOrFail($id);

        // Delete image if exists
        if ($package->image && file_exists(public_path($package->image))) {
            unlink(public_path($package->image));
        }

        $package->delete();

        return redirect()->route('treatment-packages.index')->with('success', 'Treatment package deleted successfully!');
    }



}
