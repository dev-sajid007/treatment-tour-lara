<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;

class CommonController extends Controller
{
   public function search(Request $request)
{
    $query = $request->input('query');
    $medications = Medicine::where('name', 'like', "%$query%")
                              ->take(10)
                              ->get(['id', 'name']);
    return response()->json($medications);
}

}
