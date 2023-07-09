<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class AppointmentController extends Controller
{
    public function viewMakeAppointment()
    {
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

        $exist_time = []; //ambil dari database appointment

        $available_time = array_diff($list_time, $exist_time);
        ;

        $dentists = User::where('role', '=', '2')->get();

        return view('patients.makeAppointment', ['dentists' => $dentists, 'time' => $available_time]);
    }


    public function viewPatientAppointment()
    {

        $curr = Auth::user()->user_id;
        //$appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.patient_id',$curr)->orderBy('day', 'asc')->get(['appointments.*', 'dentists.name as dentist_name']);

        $today = Carbon::now()->format('Y-m-d');

        $todayAppointment = Appointment::join('patients', 'patients.user_id', '=', 'appointments.patient_id')
            ->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')
            ->where('appointments.patient_id', $curr)
            ->whereDate('day', $today) 
            ->orderBy('day', 'desc')
            ->get(['appointments.*', 'dentists.name as dentist_name']);

        $appointments = Appointment::join('patients', 'patients.user_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.patient_id', $curr)->orderBy('day', 'desc')->paginate(2, ['appointments.*', 'dentists.name as dentist_name']);
        
        return view('patients.patientAppointment', ['appointments' => $appointments, 'todayAppointment' => $todayAppointment]);
    }

    public function viewDentistAppointment()
    {

        $curr = Auth::user()->user_id;

        $today = Carbon::now()->format('Y-m-d');
        $todayAppointment = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.dentist_id', $curr)->whereDate('day', $today)->orderBy('day', 'desc')->get(['appointments.*', 'patients.name as patient_name']);

        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.dentist_id', $curr)->orderBy('day', 'desc')->paginate(10, ['appointments.*', 'patients.name as patient_name']);

        return view('dentists.dentistAppointment', ['appointments' => $appointments, 'todayAppointment' => $todayAppointment]);
    }

    public function viewAllAppointment()
    {
        $today = Carbon::now()->format('Y-m-d');
        $todayAppointment = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->whereDate('day', $today)->orderBy('day', 'asc')->get(['appointments.*', 'patients.name as patient_name', 'dentists.name as dentist_name']);

        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->orderBy('day', 'asc')->paginate(10, ['appointments.*', 'patients.name as patient_name', 'dentists.name as dentist_name']);

        return view('receptionist.allAppointment', ['appointments' => $appointments, 'todayAppointment' => $todayAppointment]);
    }

    public function addMakeAppointment(Request $request)
{
    $request->validate([
        'dentist_id' => 'required',
        'date' => 'required',
        'time' => 'required',
        'dentist_id' => [
            'required',
            Rule::unique('appointments')->where(function ($query) use ($request) {
                return $query->where('day', $request->date)
                    ->where('time', $request->time)
                    ->where('dentist_id', $request->dentist_id);
            })->ignore($request->id),
        ],
    ], [
        'dentist_id.required' => 'Please select the dentist.',
        'date.required' => 'Please select the date.',
        'time.required' => 'Please select the time.',
        'dentist_id.unique' => 'An appointment already exists on the selected date and time with the same dentist.',
    ]);

    $appointment = new Appointment;

    $appointment->day = $request->input('date');
    $appointment->time = $request->input('time');
    $appointment->patient_id = $request->input('patient_id');
    $appointment->dentist_id = $request->input('dentist_id');
    $appointment->status = $request->input('status');

    $appointment->save();

    session()->flash('message', 'Appointment has been made.');
    return redirect()->route('patients.appointment.view');
}



    // $appointment = Appointment::create([
    //     'day' => $request['date'],
    //     'time' => $request['time'],
    //     'patient_id' => $request['patient_id'],
    //     'dentist_id ' => $request['dentist_id '],
    //     'status' => $request['status'],
    // ]);

    public function cancelAppointment($id)
    {

        $appointnment = Appointment::findOrFail($id);

        $appointnment->status = request('appointment_status');

        $appointnment->save();

        $role = Auth::user()->role;

        if ($role == 1) {
            return redirect()->route('patients.appointment.view');
        } elseif ($role == 2) {
            return redirect()->route('dentist.appointment.view');
        } else {
            return redirect()->route('receptionist.allAppointment.view');
        }


    }


}