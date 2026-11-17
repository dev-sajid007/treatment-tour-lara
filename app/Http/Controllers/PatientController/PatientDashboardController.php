<?php

namespace App\Http\Controllers\PatientController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class PatientDashboardController extends Controller
{
    public function index(Request $request)
    {
        // dd(1);
        $settings = Setting::first();
        return view('patient.dashboard.index', compact('settings'));
    }
}






