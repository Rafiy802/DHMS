<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function viewMakeAppointment(){

        //$dentists = Dentist::all();

        $dentists = User::where('role','=','2')->get();

        return view('patients.makeAppointment', ['dentists' => $dentists]);
    }


    public function viewPatientAppointment(){

        // $appointments = Appointment::where('user_id','=', $id)->paginate(8);

        // return view('patients.patientAppointment', compact('appointments'));

        $curr = Auth::user()->user_id;
        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.patient_id',$curr)->orderBy('day', 'asc')->get(['appointments.*', 'dentists.name as dentist_name']);
        //$appointments = Appointment::join('users', 'users.user_id', '=', 'appointments.patient_id')->where('appointments.patient_id',$curr)->orderBy('appointments.day', 'asc')->get(['appointments.*', 'users.name as name']);

        // $dentists = User::join('appointments', 'appointments.id', '=', 'appointments.patient_id')->get();

        return view('patients.patientAppointment', ['appointments' => $appointments]);
        // return view('patients.patientAppointment', ['appointments' => $appointments, 'dentists' => $dentists]);
    }

    public function viewDentistAppointment(){

        // $appointments = Appointment::where('user_id','=', $id)->paginate(8);

        // return view('patients.patientAppointment', compact('appointments'));

        $curr = Auth::user()->user_id;
        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.dentist_id',$curr)->orderBy('day', 'asc')->get(['appointments.*', 'patients.name as patient_name']);
        //$appointments = Appointment::join('users', 'users.user_id', '=', 'appointments.patient_id')->where('appointments.patient_id',$curr)->orderBy('appointments.day', 'asc')->get(['appointments.*', 'users.name as name']);

        // $dentists = User::join('appointments', 'appointments.id', '=', 'appointments.patient_id')->get();

        return view('dentists.dentistAppointment', ['appointments' => $appointments]);
        // return view('patients.patientAppointment', ['appointments' => $appointments, 'dentists' => $dentists]);
    }

    public function viewAllAppointment(){

        //$appointments = Appointment::all();
        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->orderBy('day', 'asc')->get(['appointments.*', 'patients.name as patient_name', 'dentists.name as dentist_name']);

        return view('receptionist.allAppointment', ['appointments' => $appointments]);
    }

    public function addMakeAppointment(){

        $appointment = new Appointment;

        $appointment->day = request('date');
        $appointment->time = request('time');
        $appointment->patient_id = request('patient_id');
        $appointment->dentist_id = request('dentist');
        $appointment->status = request('status');

        $appointment->save();

        return redirect()->route('patients.appointment.view');
    }


    public function cancelAppointment($id)
    {

        $appointnment = Appointment::findOrFail($id);


        // $appointnment->status = "Cancelled";
        $appointnment->status = request('appointment_status');

        $appointnment->save();

        return redirect()->route('patients.appointment.view');
    }


}
