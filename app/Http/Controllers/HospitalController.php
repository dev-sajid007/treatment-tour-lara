<?php

namespace App\Http\Controllers;
use App\Models\Hospital;

use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::all();
        return response()->json($hospitals , 200);
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
}
