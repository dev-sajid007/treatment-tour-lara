<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;

class HospitalUserController extends Controller
{
    public function user(Request $request, $hospitalId)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'hospital_id' => $hospitalId,
            'password' => Hash::make($request->password),
        ]);

        // Assign the specified role
        $user->assignRole('hospital');

        return redirect()->back()->with('success', 'Hospital user assigned successfully!');
    }



    public function hospitalUser()
    {
        $auth = Auth::user();
        $users = User::role('hospital')
                ->where('hospital_id', $auth->hospital_id)
                ->get();


        return view('user.hospital_user', compact('users')); 
    }

}
