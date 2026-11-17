<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Hospital\HospitalSetting;
use App\Models\Country;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\State;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::with('country', 'state_city')
                             ->get(); // Eager load relationships
        
        //return $hospitals;
        return view('admin.hospitals.index', compact('hospitals'));
    }

    public function hospitalByCountry($country)
    {
        $hospitals = Hospital::where('country', $country)->get();
        return response()->json($hospitals , 200);
    }
    
    public function hospitalByState($state)
    {
        $hospitals = Hospital::where('city', $state)->get();
        return response()->json($hospitals , 200);
    }

    // Show form to create / add a new Hospital
    public function create()
    {
        $countries = Country::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $users = User::role('hospital')->get();
        return view('admin.hospitals.create', compact('countries', 'categories', 'subcategories', 'users'));
    }

    // Store a new hospital
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'address' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'country_id' => 'required|exists:countries,id'
        ]);

        // Handle hospital image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images/hospitals/'), $imageName);
            $imagePath = $imageName;
        }        

        // Create the hospital
        $hospital = Hospital::create([
            'name' => $request->name,            
            'description' => $request->description,
            'address' => $request->address,
            'image' => $imagePath,
            'country_id' => $request->country_id,
            'city_id' => $request->state_id,
            'established' => '',
            'no_of_beds' => '',
            'speciality_type' => ''
        ]);

        return redirect()->route('admin.hospitals.index')->with('success', 'Clinic created successfully.');
    }



    public function show($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospitalSettings = HospitalSetting::where('hospital_id', $hospital->id)->first();

        $countries = Country::get();

        $cities = State::get();
 
        return view('admin.hospitals.show', compact('hospital', 'hospitalSettings', 'countries', 'cities'));
    }

    public function edit($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospitalSettings = HospitalSetting::where('hospital_id', $hospital->id)->first();

        $countries = Country::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $users = User::role('hospital')->get();

        return view('admin.hospitals.edit', compact('hospital', 'hospitalSettings', 'countries', 'categories', 'subcategories', 'users'));
    }


    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'description' => 'nullable',
    //         'address' => 'nullable',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    //         'country_id' => 'required|exists:countries,id'
    //     ]);

    //     $hospital = Hospital::findOrFail($id);

    //     // Handle hospital image upload
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('storage/images/hospitals/'), $imageName);
            
    //         // Delete old image if exists
    //         if ($hospital->image && file_exists(public_path('storage/images/hospitals/' . $hospital->image))) {
    //             unlink(public_path('storage/images/hospitals/' . $hospital->image));
    //         }

    //         $hospital->image = $imageName;
    //     }

    //     // Update hospital details
    //     $hospital->update([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'address' => $request->address,
    //         'country_id' => $request->country_id,
    //         'city_id' => $request->state_id,
    //         'established' => $request->established ?? $hospital->established,
    //         'no_of_beds' => $request->no_of_beds ?? $hospital->no_of_beds,
    //         'speciality_type' => $request->speciality_type ?? $hospital->speciality_type
    //     ]);

    //     return redirect()->route('admin.hospitals.index')->with('success', 'Hospital updated successfully.');
    // }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'address' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'country_id' => 'required|exists:countries,id',
       // 'city_id' => 'required|exists:states,id',
        'established' => 'nullable',
        'no_of_beds' => 'nullable',
        'speciality_type' => 'nullable',
        'Speciality' => 'nullable|string',
        'Infrastructure' => 'nullable',
        'Facility' => 'nullable',
        'phone_number' => 'nullable|max:17',
    ]);

    $hospital = Hospital::findOrFail($id);

    // Handle hospital image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/images/hospitals/'), $imageName);

        // Delete old image if it exists
        if ($hospital->image && file_exists(public_path('storage/images/hospitals/' . $hospital->image))) {
            unlink(public_path('storage/images/hospitals/' . $hospital->image));
        }

        $hospital->image = $imageName;
    }

    // Update hospital fields
    $hospital->name = $request->name;
    $hospital->address = $request->address;
    $hospital->country_id = $request->country_id;
    $hospital->city_id = $request->city_id;
    $hospital->established = $request->established;
    $hospital->no_of_beds = $request->no_of_beds;
    $hospital->speciality_type = $request->speciality_type;
    $hospital->Speciality = $request->speciality;
    $hospital->phone_number = $request->phone_number;
    $hospital->website = $request->website;
    $hospital->Infrastructure = $request->infrastructure;
    $hospital->Facility = $request->facility;
    $hospital->description = $request->description;

    $hospital->save();

    return redirect()->back()->with('success', 'Hospital updated successfully.');
}



    public function destroy($id)
{
    $hospital = Hospital::findOrFail($id);
    // Delete hospital image if exists
    if ($hospital->image && file_exists(public_path('storage/images/hospitals/' . $hospital->image))) {
        unlink(public_path('storage/images/hospitals/' . $hospital->image));
    }
    
    // Delete hospital record
    $hospital->delete();
    
    return redirect()->route('admin.hospitals.index')->with('success', 'Hospital deleted successfully.');
}


    public function hospitalRequest()
    {
        $hospitals = Hospital::with('country', 'state_city')
                             ->where('status', 'Pending')->get(); // Eager load relationships
        
        //return $hospitals;
        return view('admin.hospitals.request', compact('hospitals'));
    }



    public function approve($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->status = 'Approved';
        $hospital->save();

        return redirect()->route('admin.hospitals.index')->with('success', 'Hospital approved successfully.');
    }

    public function cancel($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->status = 'Cancel';
        $hospital->save();

        return redirect()->route('admin.hospitals.index')->with('success', 'Hospital request has been canceled.');
    }








}