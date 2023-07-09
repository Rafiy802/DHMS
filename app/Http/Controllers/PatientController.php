<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //

    public function viewAllPatients(){

        $patients = Patient::simplePaginate(10);

        //$dentists = User::where('role','=','2')->get();

        return view('dentists.viewAllPatients', ['patients' => $patients]);
    }

    public function viewPatient($id)
    {
        $patient = Patient::join('users', 'users.user_id', '=', 'patients.patient_id')->where('patients.patient_id',$id)->get(['users.*', 'patients.ICnum as IC']);

        return view('dentists.viewPatient', ['patient' => $patient]);
    }


    public function viewEditPatientInfo($id){

        $patient = Patient::join('users', 'users.user_id', '=', 'patients.patient_id')->where('patients.patient_id',$id)->get(['users.*', 'patients.ICnum as IC']);
        return view('receptionist.editPatientInfo', ['patient' => $patient]);
    }

    public function editPatientInfo($id)
    {

        $user = User::findOrFail($id);
        $patient = Patient::findOrFail($id);


        $user->name = request('name');
        $user->address = request('address');
        $user->mobile_num = request('mobile_num');

        $patient->name = request('name');

        $user->save();
        $patient->save();

        return redirect()->route('dentist.patient.view', $id);
    }

}
