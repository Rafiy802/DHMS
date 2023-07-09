<?php

namespace App\Http\Controllers;

use App\Models\Patient;
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

        //$patient = Patient::find($id);
        $patient = Patient::join('users', 'users.user_id', '=', 'patients.patient_id')->where('patients.patient_id',$id)->get(['users.*', 'patients.ICnum as IC']);

        return view('dentists.viewPatient', ['patient' => $patient]);
    }

}
