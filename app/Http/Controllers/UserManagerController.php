<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationNotification;
use App\Mail\PasswordChangeNotification;
use Spatie\Permission\Models\Role; 
use Illuminate\Support\Facades\Validator;
use Auth;

class UserManagerController extends Controller
{
    public function registration()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $role = $request->role;

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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->serial = $customId;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole($role);

        // Send mail
       // Mail::to($user->email)->send(new UserRegistrationNotification($user)); 

        return redirect()->back()->with('success', 'User has been successfully created.');
    }


    public function users()
    {
        $users = User::with('roles')->get();
        return view('user.list', compact('users'));
    }


    public function passwordChange()
    {
        return view('user.password');
    }


    public function passwordReset(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $auth = auth::user()->id;
        $user = User::find($auth);
        $user->password = Hash::make($request->password);
        $user->save();

        Mail::to($user->email)->send(new PasswordChangeNotification($user)); 

        return redirect()->back()->with('success', 'Your  password has been successfully changed.');
    }


}
