<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\User;
use Spatie\Permission\Models\Role; 
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{
    public function partnerAdd()
    {
        return view('partner.create');
    }

    public function store(Request $request)
    {

        $request->validate([
             'name' => 'required|max:255',
             'email' => 'required|email|max:255|unique:users,email',
        ]);


        // Check partner type and process accordingly
        if ($request->partnerType === 'hospital') {
        
            $hospital = new Hospital();
            $hospital->name = $request->partnerName;
            $hospital->status = 'Pending';
            $hospital->save();


            $role = 'hospital';

            $prefix = strtoupper(substr($role, 0, 2)); // e.g., 'AD' for admin

            // Find the last custom ID with this prefix
            $lastUserWithPrefix = User::where('serial', 'like', $prefix . '%')
                                        ->orderBy('serial', 'desc')
                                        ->first();

            if ($lastUserWithPrefix) {
                $lastIdNumber = (int)substr($lastUserWithPrefix->serial, 2);
                $newIdNumber = $lastIdNumber + 1;
            } else {
                $newIdNumber = 111;
            }

            $customId = $prefix . $newIdNumber;
            $user  = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->hospital_id = $hospital->id;
            $user->serial = $customId;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->assignRole('hospital');
       

        } elseif ($request->partnerType  === 'clinic') {
            $clinic = new Clinic();
            $clinic->name = $request->partnerName;
            $clinic->status = 'Pending';
            $clinic->save();

            $role = 'clinic';

            $prefix = strtoupper(substr($role, 0, 2)); // e.g., 'AD' for admin

            // Find the last custom ID with this prefix
            $lastUserWithPrefix = User::where('serial', 'like', $prefix . '%')
                                        ->orderBy('serial', 'desc')
                                        ->first();

            if ($lastUserWithPrefix) {
                $lastIdNumber = (int)substr($lastUserWithPrefix->serial, 2);
                $newIdNumber = $lastIdNumber + 1;
            } else {
                $newIdNumber = 111;
            }

             $customId = $prefix . $newIdNumber;
            $user  = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->clinic_id = $clinic->id;
            $user->serial = $customId;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole('clinic');

        } elseif ($request->partnerType  === 'sexologist') {

            
            $role = 'sexologist';

            $prefix = strtoupper(substr($role, 0, 2)); // e.g., 'AD' for admin

            // Find the last custom ID with this prefix
            $lastUserWithPrefix = User::where('serial', 'like', $prefix . '%')
                                        ->orderBy('serial', 'desc')
                                        ->first();

            if ($lastUserWithPrefix) {
                $lastIdNumber = (int)substr($lastUserWithPrefix->serial, 2);
                $newIdNumber = $lastIdNumber + 1;
            } else {
                $newIdNumber = 111;
            }
             $customId = $prefix . $newIdNumber;
            $user  = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->serial = $customId;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole('sexologist');

        }elseif ($request->partnerType  === 'beautician') {

              
            $role = 'beautician';

            $prefix = strtoupper(substr($role, 0, 2)); // e.g., 'AD' for admin

            // Find the last custom ID with this prefix
            $lastUserWithPrefix = User::where('serial', 'like', $prefix . '%')
                                        ->orderBy('serial', 'desc')
                                        ->first();

            if ($lastUserWithPrefix) {
                $lastIdNumber = (int)substr($lastUserWithPrefix->serial, 2);
                $newIdNumber = $lastIdNumber + 1;
            } else {
                $newIdNumber = 111;
            }

             $customId = $prefix . $newIdNumber;
            $user  = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->serial = $customId;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole('beautician');

        }elseif ($request->partnerType  === 'doctor') {

              
            $role = 'doctor';

            $prefix = strtoupper(substr($role, 0, 2)); // e.g., 'AD' for admin

            // Find the last custom ID with this prefix
            $lastUserWithPrefix = User::where('serial', 'like', $prefix . '%')
                                        ->orderBy('serial', 'desc')
                                        ->first();

            if ($lastUserWithPrefix) {
                $lastIdNumber = (int)substr($lastUserWithPrefix->serial, 2);
                $newIdNumber = $lastIdNumber + 1;
            } else {
                $newIdNumber = 111;
            }
             $customId = $prefix . $newIdNumber;
            $user  = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->serial = $customId;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole('doctor');

        }
        else {
          

        }


        return redirect()->route('web.home')->with('success', 'Your Submission successfully recorded.');

    }




}
