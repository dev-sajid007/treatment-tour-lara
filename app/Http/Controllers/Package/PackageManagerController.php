<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TreatmentPackage;
use App\Models\Country;
use App\Models\TreatmentCategory;

class PackageManagerController extends Controller
{
    public function packages(Request $request)
    {
        // Fetch categories and countries for the filters
        $treatmentcategories = TreatmentCategory::all();
        $countries = Country::all();

        // Start building the query
        $query = TreatmentPackage::query();

        // Apply filters if selected
        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        if ($request->filled('treatment_category_id')) {
            $query->where('treatment_category_id', $request->treatment_category_id);
        }

        // If search parameters are present, fetch all records (no pagination)
        if ($request->filled('country_id') || $request->filled('treatment_category_id')) {
            $packages = $query->get();  // Get all matching records without pagination
        } else {
            // If no filters are applied, paginate 10 packages per page
            $packages = $query->paginate(10);
        }

        return view('package.package_list', compact('packages', 'treatmentcategories', 'countries'));
    }



    public function packageView($id)
    {

        $package = TreatmentPackage::find($id);

        return view('package.view', compact('package'));
    }

}
