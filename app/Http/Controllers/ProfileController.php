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

        $patient->name = request('name');

        $user->name = request('name');
        $user->address = request('address');
        $user->mobile_num = request('mobile_num');

        $user->save();
        $patient->save();

        return redirect()->route('patients.profile');
    }

    public function viewDentistProfile(){

        //$dentists = Dentist::all();
        $curr = Auth::user()->user_id;
        $dentists = Dentist::join('users', 'users.user_id', '=', 'dentists.dentist_id')->where('dentists.dentist_id',$curr)->get(['users.*', 'dentists.ICnum as IC']);

        return view('dentists.dentistProfile', ['dentists' => $dentists]);
    }

    public function viewEditDentistProfile(){

        //$dentists = Dentist::all();
        $curr = Auth::user()->user_id;
        $dentists = Dentist::join('users', 'users.user_id', '=', 'dentists.dentist_id')->where('dentists.dentist_id',$curr)->get(['users.*', 'dentists.ICnum as IC']);

        return view('dentists.editDentistProfile', ['dentists' => $dentists]);
    }

    public function editDentistProfile($id)
    {

        $user = User::findOrFail($id);
        $dentist = Dentist::findOrFail($id);

        $dentist->name = request('name');

        $user->name = request('name');
        $user->address = request('address');
        $user->mobile_num = request('mobile_num');

        $user->save();
        $dentist->save();

        return redirect()->route('dentist.profile');
    }
}
