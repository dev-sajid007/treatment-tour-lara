<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use validate;
class LoginController extends Controller
{
// public function login(Request $request)
// {
//     $request->validate([
//         'email' => 'required|string|email',
//         'password' => 'required|string',
//     ]);

//     $user = User::where('email', $request->email)->first();

//     if (!$user || !Hash::check($request->password, $user->password)) {
//         return response()->json([
//             'message' => 'Invalid credentials',
//             'success' => false,
//             'status' => 401
//         ]);
//     }

//     $token = $user->createToken('auth_token')->plainTextToken;

   
//     if ($user->user_type === 'doctor') {
//         $doctor = Doctor::whereUserId($user->id)->first();
//         if ($doctor) {
//             return response()->json([
//                 'message' => 'Login successful',
//                 'user_type' => 'doctor',
//                 'doctor_id' => $doctor->id,
//                 'user' => $user,
//                 'status' => 200,
//                 'access_token' => $token,
//                 'token_type' => 'Bearer',
//             ]);
//         }
//     } elseif ($user->user_type === 'patient') {
//         $patient = Patient::whereUserId($user->id)->first();
//         if ($patient) {
//             return response()->json([
//                 'message' => 'Login successful',
//                 'user_type' => 'patient',
//                 'patient_id' => $patient->id,
//                 'user' => $user,
//                 'status' => 200,
//                 'access_token' => $token,
//                 'token_type' => 'Bearer',
//             ]);
//         }
//     }

  
//     return response()->json([
//         'message' => 'Login successful',
//         'user_type' => 'user',
//         'user' => $user,
//         'status' => 200,
//         'access_token' => $token,
//         'token_type' => 'Bearer',
//     ]);
// }




public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('Personal Access Token')->plainTextToken;

    return response()->json(['token' => $token], 200);
}



}
