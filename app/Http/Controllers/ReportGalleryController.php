<?php

namespace App\Http\Controllers;

use App\Models\MedicalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ReportGalleryController extends Controller
{
    public function index()
    {
        $reports = MedicalReport::where('user_id', Auth::id())->latest()->get();
        return view('report_gallery.index', compact('reports'));
    }

    public function create()
    {
        return view('report_gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'report_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('report_image')) {
            $file = $request->file('report_image');
            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/medical_reports'), $imageName);
            $imagePath = 'uploads/medical_reports/' . $imageName;
        }

        MedicalReport::create([
            'title' => $request->title,
            'report_image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('report_galleries.index')->with('success', 'Medical report uploaded successfully.');
    }

    public function show(MedicalReport $medicalReport)
    {
        return view('report_gallery.show', compact('medicalReport'));
    }

    public function edit($id)
    {
        $medicalReport = MedicalReport::find($id);

        return view('report_gallery.edit', compact('medicalReport'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'report_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $medicalReport = MedicalReport::find($id);

        if ($request->hasFile('report_image')) {
            if (File::exists(public_path($medicalReport->report_image))) {
                File::delete(public_path($medicalReport->report_image));
            }

            $file = $request->file('report_image');
            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/medical_reports'), $imageName);
            $medicalReport->report_image = 'uploads/medical_reports/' . $imageName;
        }

        $medicalReport->title = $request->title;
        $medicalReport->save();

        return redirect()->route('report_galleries.index')->with('success', 'Medical report updated successfully.');
    }

    public function destroy($id)
    {
        $medicalReport = MedicalReport::find($id);
        
        if (File::exists(public_path($medicalReport->report_image))) {
            File::delete(public_path($medicalReport->report_image));
        }

        $medicalReport->delete();

        return redirect()->route('report_galleries.index')->with('success', 'Medical report deleted.');
    }


}
