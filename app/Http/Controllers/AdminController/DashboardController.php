<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $settings = Setting::first();
    $doctorCount = Doctor::WhereNotNull('user_id')->count();
    $hospitalCount = Hospital::count();
    
   return view('admin.dashboard.index', compact( 'doctorCount' , 'hospitalCount' ,'settings'));
}

   
    

}
