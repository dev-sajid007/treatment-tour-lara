<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index(){
        $settings = Setting::first();
        return view('admin/settings/index' , compact('settings'));
    }


    public function update(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'website_name' => 'required|string|max:255',
            'business_email' => 'required|email',
            'business_phone' => 'required|string|max:20',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'favicon' => 'image|max:2048', 
            'currency' => 'nullable|string|max:255',
            'address' => 'nullable',
            'company_foundation_year' => 'required',
        ]);
    
        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $settings = Setting::firstOrCreate([]);
    
        // Update settings fields
        $settings->update([
            'website_name' => $request->input('website_name'),
            'business_email' => $request->input('business_email'),
            'business_phone' => $request->input('business_phone'),
            'currency' => $request->input('currency'),
            'address' => $request->input('address'),
            'company_foundation_year'=> $request->input('company_foundation_year'),
        ]);
    
    
    // Handle logo upload
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName); 
        
            // Update the logo path using the update method
            $settings->update(['logo' => $imageName]);
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $image = $request->file('favicon');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName); 
        
            // Update the favicon path using the update method
            $settings->update(['favicon' => $imageName]);
        }

    
        // Redirect back with success message
        return redirect()->route('settings')->with('success', 'Settings updated successfully.');
    }

    public function updateMenuAccess(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'employee_management' => 'nullable',
            'notes' => 'nullable',
            'expense' => 'nullable',
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $settings = Setting::firstOrCreate([]);

        // Update menu access settings
        $settings->update([
            'employee_management' => $request->input('employee_management', 0),
            'notes' => $request->input('notes', 0),
            'expense' => $request->input('expense', 0),
        ]);

        // Redirect back with success message
        return redirect()->route('settings')->with('success', 'Menu Access settings updated successfully.');
    }

}
