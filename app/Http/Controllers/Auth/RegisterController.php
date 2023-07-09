<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dentist;
use App\Models\Patient;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'IC' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'mobile_num' => ['required', 'numeric'],
            'birthdate' => ['required', 'date'],
            'role' => ['required'],
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
        //     'address' => $data['address'],
        //     'birthdate' => $data['birthdate'],
        //     'mobile_num' => $data['mobile_num'],
        //     'role' => $data['role'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);


        $user=User::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'birthdate' => $data['birthdate'],
            'mobile_num' => $data['mobile_num'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($user->role == '1'){
            Patient::create([
                'patient_id'=>$user->user_id,
                'user_id'=>$user->user_id,
                'name' => $data['name'],
                'ICnum' => $data['IC'],
            ]);
        }
        else {
            Dentist::create([
                'dentist_id'=>$user->user_id,
                'user_id'=>$user->user_id,
                'name' => $data['name'],
                'ICnum' => $data['IC'],
            ]);
        }
        // event(new Registered($user));

        return $user;

    }
}
