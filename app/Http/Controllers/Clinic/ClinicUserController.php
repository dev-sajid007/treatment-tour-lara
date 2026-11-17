<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;

class ClinicUserController extends Controller
{
   public function user(Request $request, $clinicId)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'clinic_id' => $clinicId,
            'password' => Hash::make($request->password),
        ]);

        // Assign the specified role
        $user->assignRole('clinic');

        return redirect()->back()->with('success', 'Clinic user assigned successfully!');
    }


    public function clinicUser()
    {
        $auth = Auth::user();
        $users = User::role('clinic')
                ->where('clinic_id', $auth->clinic_id)
                ->get();


        return view('user.clinic_user', compact('users')); 
    }


}
