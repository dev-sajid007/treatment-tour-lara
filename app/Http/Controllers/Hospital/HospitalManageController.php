<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital\HospitalSetting;

class HospitalManageController extends Controller
{
public function hospitalSettingStore(Request $request, $hospitalId)
{
    $request->validate([
        'facebook' => 'nullable|string|max:150',
        'instagram' => 'nullable|string|max:150',
        'twitter' => 'nullable|string|max:150',
        'linkedin' => 'nullable|string|max:150',
        'youtube' => 'nullable|string|max:150',
        'website' => 'nullable|string|max:80',
        'speciality' => 'nullable|string',
        'infrastructure' => 'nullable|string',
        'facility' => 'nullable|string',
    ]);

    HospitalSetting::create([
        'hospital_id' => $hospitalId,
        'facebook' => $request->facebook,
        'instagram' => $request->instagram,
        'twitter' => $request->twitter,
        'linkedin' => $request->linkedin,
        'youtube' => $request->youtube,
        'website' => $request->website,
        'speciality' => $request->speciality,
        'infrastructure' => $request->infrastructure,
        'facility' => $request->facility,
    ]);

    return redirect()->back()->with('success', 'Hospital settings created successfully!');
}

public function hospitalSettingUpdate(Request $request, $id)
{
    $request->validate([
        'facebook' => 'nullable|string|max:150',
        'instagram' => 'nullable|string|max:150',
        'twitter' => 'nullable|string|max:150',
        'linkedin' => 'nullable|string|max:150',
        'youtube' => 'nullable|string|max:150',
        'website' => 'nullable|string|max:80',
        'speciality' => 'nullable|string',
        'infrastructure' => 'nullable|string',
        'facility' => 'nullable|string',
    ]);

    $hospitalSettings = HospitalSetting::findOrFail($id);
    $hospitalSettings->update([
        'facebook' => $request->facebook,
        'instagram' => $request->instagram,
        'twitter' => $request->twitter,
        'linkedin' => $request->linkedin,
        'youtube' => $request->youtube,
        'website' => $request->website,
        'speciality' => $request->speciality,
        'infrastructure' => $request->infrastructure,
        'facility' => $request->facility,
    ]);

    return redirect()->back()->with('success', 'Hospital settings updated successfully!');
}
}
