<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSetting;

class HomeSettingController extends Controller
{
public function edit()
    {
        $setting = HomeSetting::first(); // Only one row
        return view('home_settings.edit', compact('setting'));
    }

public function storeOrUpdate(Request $request)
{
    $request->validate([
        'top_title' => 'nullable|string|max:80',
    
        // Add more field validations as needed
    ]);

    $data = $request->except('_token');

    $setting = HomeSetting::first();

        

    // Handle image upload and delete old image if it exists
    if ($request->hasFile('top_image')) {
        if ($setting && !empty($setting->top_image) && file_exists(public_path($setting->top_image))) {
            unlink(public_path($setting->top_image));
        }



        $file = $request->file('top_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $data['top_image'] = 'uploads/' . $filename;
    }

    // Update or create
    if ($setting) {
        $setting->update($data);
    } else {
        HomeSetting::create($data);
    }

    return redirect()->back()->with('success', 'Home settings saved successfully!');
}

}
