<?php

namespace App\Http\Controllers;
use App\Models\Dentist;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function viewPatientProfile(){

        //$dentists = Dentist::all();
        $curr = Auth::user()->user_id;
        $Patient = Patient::join('users', 'users.user_id', '=', 'patients.patient_id')->where('patients.patient_id',$curr)->get(['users.*', 'patients.ICnum as IC']);

        return view('patients.profile', ['patient' => $Patient]);
    }

    public function viewEditPatientProfile(){

        //$dentists = Dentist::all();
        $curr = Auth::user()->user_id;
        $Patient = Patient::join('users', 'users.user_id', '=', 'patients.patient_id')->where('patients.patient_id',$curr)->get(['users.*', 'patients.ICnum as IC']);

        return view('patients.editPatientProfile', ['patient' => $Patient]);
    }

    public function editPatientProfile($id)
    {

        $user = User::findOrFail($id);
        $patient = Patient::findOrFail($id);


        $user->name = request('name');
        $user->address = request('address');
        $user->mobile_num = request('mobile_num');

        $user->save();
        $patient->save();

        return redirect()->route('patients.profile');
    }

    
}
