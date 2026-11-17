<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);



            $role = 'patient';

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
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->serial = $customId;
            $user->password = Hash::make($data['password']);
            $user->save();

            $user->assignRole('patient');


            return $user;


    }
}
