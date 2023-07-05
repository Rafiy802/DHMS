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
        // $exist_time = array('10:15:00', '10:30:00', '10:45:00');

        // $values = [
        //     '10:00:00' => '10:00 AM',
        //     '10:15:00' => '10:15 AM',
        //     '10:30:00' => '10:30 AM',
        //     '10:45:00' => '10:45 AM',
        //     '11:00:00' => '11:00 AM',
        //     '11:15:00' => '11:15 AM',
        //     '11:30:00' => '11:30 AM',
        //     '11:45:00' => '11:45 AM',
        //     '12:00:00' => '12:00 AM',
        //     '12:15:00' => '12:15 AM',
        //     '12:30:00' => '12:30 AM',
        //     '12:45:00' => '12:45 AM',
        //     '13:00:00' => '01:00 PM'
        // ];

        $list_time = [
            '10:00:00',
            '10:15:00',
            '10:30:00',
            '10:45:00',
            '11:00:00',
            '11:15:00',
            '11:30:00',
            '11:45:00',
            '12:00:00',
            '12:15:00',
            '12:30:00',
            '12:45:00',
            '13:00:00'
        ];

        $exist_time = [];//ambil dari database appointment

        $available_time = array_diff($list_time, $exist_time);;

        $dentists = User::where('role','=','2')->get();

        return view('patients.makeAppointment', ['dentists' => $dentists, 'time' => $available_time]);
    }


    public function viewPatientAppointment(){

        $curr = Auth::user()->user_id;
        //$appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.patient_id',$curr)->orderBy('day', 'asc')->get(['appointments.*', 'dentists.name as dentist_name']);
        $appointments = Appointment::join('patients', 'patients.user_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.patient_id',$curr)->orderBy('day', 'asc')->get(['appointments.*', 'dentists.name as dentist_name']);
        return view('patients.patientAppointment', ['appointments' => $appointments]);
    }

    public function viewDentistAppointment(){

        $curr = Auth::user()->user_id;
        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.dentist_id',$curr)->orderBy('day', 'asc')->get(['appointments.*', 'patients.name as patient_name']);

        return view('dentists.dentistAppointment', ['appointments' => $appointments]);
    }

    public function viewAllAppointment(){

        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->orderBy('day', 'asc')->simplePaginate(10, ['appointments.*', 'patients.name as patient_name', 'dentists.name as dentist_name']);

        return view('receptionist.allAppointment', ['appointments' => $appointments]);
    }

    public function addMakeAppointment(Request $request){

        $appointment = new Appointment;

        $appointment->day = request('date');
        $appointment->time = request('time');
        $appointment->patient_id = request('patient_id');
        $appointment->dentist_id = request('dentist');
        $appointment->status = request('status');

        $appointment->save();


        /*
        Untuk Rafiy Tersayang,

        Ini adalah sebuah surat cinta untuk mu. Semoga kamu menemukannya bermanfaat.

        Cinta,

        Ibumu
        */  
        // $appointment = Appointment::create([
        //     'day' => $request['date'],
        //     'time' => $request['time'],
        //     'patient_id' => $request['patient_id'],
        //     'dentist_id ' => $request['dentist_id '],
        //     'status' => $request['status'],
        // ]);

        return redirect()->route('patients.appointment.view');
    }


    public function cancelAppointment($id)
    {

        $appointnment = Appointment::findOrFail($id);

        $appointnment->status = request('appointment_status');

        $appointnment->save();

        $role = Auth::user()->role;

        if($role == 1){
            return redirect()->route('patients.appointment.view');
        }
        elseif($role == 2){
            return redirect()->route('dentist.appointment.view');
        }else{
            return redirect()->route('receptionist.allAppointment.view');
        }

        
    }


}
