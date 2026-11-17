<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor\DoctorProfile;
use App\Models\User;
use App\Models\Category;
use App\Models\Clinic;
use App\Models\SubCategory;
use App\Models\Speciality;
use App\Models\Hospital;
use App\Models\Patient\PatientAppointment;
use App\Models\HomeSetting;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Podcast;
use App\Models\TreatmentPackage;
use App\Models\Country;
use App\Models\State;
use Auth;
use DB;

class WebController extends Controller
{
    public function index()
    {
        
        $home_setting = HomeSetting::first();
      
        $blogs = Blog::latest()->take(4)->get();
        $faqs = Faq::latest()->take(10)->get();
        $podcasts = Podcast::latest()->take(3)->get();
        $packages = TreatmentPackage::latest()->take(15)->get();
        return view('frontend.index', compact('home_setting', 'blogs', 'faqs', 'podcasts', 'packages'));
    }

    public function doctor(Request $request, $country, $category)
    {
        $doctors = DoctorProfile::where('country_id', $country)
        ->where('category_id', $category)
        ->with('user') 
        ->get();


        //dd($doctors);
        return view('frontend.doctor', compact('doctors'));
    }

    public function hospital(Request $request, $country)
    {
        // $hospitals = Hospital::where('country_id', $country)
        //     ->get();

        $query = Hospital::where('country_id', $country);

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $hospitals = $query->paginate(6);

        $country = Country::find($country);

        $countries = Country::get();
        $cities = State::get();
        return view('frontend.hospital', compact('hospitals', 'country','countries', 'cities'));
    }


    public function medicalTreatment($id)
    {
        $sub= SubCategory::find($id);
        return view('frontend.medical_treatment', compact('sub'));
    }

    public function CosmeticTreatment($id)
    {
      $sub= SubCategory::find($id);

      $clinics = Clinic::join('clinic_subcategory', 'clinics.id', '=', 'clinic_subcategory.clinic_id')  
            ->join('sub_categories', 'clinic_subcategory.subcategory_id', '=', 'sub_categories.id')  
            ->select('sub_categories.id as subcategory_id', 'sub_categories.name as subcategory_name', 'clinics.*')  
            ->where('sub_categories.id', $id)  
            ->get();


       //dd($clinics);
        return view('frontend.cosmetic_treatment', compact('sub', 'clinics'));
    }


    public function specialCosTreatment($id)
    {
      $sub= Speciality::find($id);

        $clinics = Clinic::join('clinic_speciality', 'clinics.id', '=', 'clinic_speciality.clinic_id')
            ->join('specialities', 'clinic_speciality.speciality_id', '=', 'specialities.id')
            ->select('specialities.id as speciality_id', 'specialities.name as speciality_name', 'clinics.*')
            ->where('specialities.id', $id)
            ->get();



       //dd($clinics);
        return view('frontend.cosmetic_treatment', compact('sub', 'clinics'));
    }


    


    public function appointment($doctor)
    {
        $doctor = DoctorProfile::findOrFail($doctor);
        return view('frontend.appointment', compact('doctor'));
    }



    public function onlineAppointment(Request $request, $doctor)
    {
        $request->validate([
            'doctor_id' => 'nullable|exists:users,id',
            //'clinic_id' => 'nullable|exists:clinics,id',
            //'hospital_id' => 'nullable|exists:hospitals,id',
            'patient_id' => 'nullable|exists:users,id',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'reason' => 'nullable|string',
        ]);


        $appointment = New PatientAppointment();
        $appointment->doctor_id = $doctor;
        $appointment->patient_id = Auth::user()->id;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->reason = $doctor;
        $appointment->save();


        return redirect()->route('home')->with('success', 'Thanks your appointment request');
    }


    public function doctorAbout($doctor)
    {
        $doctor = DoctorProfile::where('id', $doctor)
        ->with('user') 
        ->first();
        
       

        
        return view('frontend.doctor_about', compact('doctor'));
    }

    public function partner()
    {

        return view('frontend.partner');
    }



   public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $uploadPath = public_path('uploads/ckeditor'); // Target directory

            // Automatically create the directory if it doesn't exist
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0775, true); // Create the directory with appropriate permissions
            }

            // Move the file to the directory
            $file->move($uploadPath, $filename);

            // Generate the file URL
            $url = asset('uploads/ckeditor/' . $filename);

            return response()->json([
                'uploaded' => true,
                'url' => $url,
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'No file uploaded.',
            ],
        ]);
    }



}
