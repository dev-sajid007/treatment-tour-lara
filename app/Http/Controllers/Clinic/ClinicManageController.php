<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clinic\ClinicSetting;

class ClinicManageController extends Controller
{
    public function clinicSettingStore(Request $request, $clinicId)
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

    ClinicSetting::create([
        'clinic_id' => $clinicId,
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

public function clinicSettingUpdate(Request $request, $id)
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

    $hospitalSettings = ClinicSetting::findOrFail($id);
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
