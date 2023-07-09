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
        $role = Auth::user()->role;

        $dentists = User::where('role', '=', '2')->get();
        $patient = User::where('role', '=', '1')->get();


        if ($role == 1) {
            return view('patients.makeAppointment', ['dentists' => $dentists]);
        } elseif ($role == 2) {
            return view('dentists.dentistMakeAppointment', ['patients' => $patient]);
        } else {
            return view('receptionist.receptionistMakeAppointment', ['dentists' => $dentists, 'patients' => $patient]);
        }
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
            ->orderBy('day', 'asc')
            ->get(['appointments.*', 'dentists.name as dentist_name']);

        $appointments = Appointment::join('patients', 'patients.user_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.patient_id', $curr)->whereDate('day', '>', $today)->orderBy('day', 'asc')->paginate(10, ['appointments.*', 'dentists.name as dentist_name']);

        return view('patients.patientAppointment', ['appointments' => $appointments, 'todayAppointment' => $todayAppointment]);
    }

    public function viewDentistAppointment()
    {

        $curr = Auth::user()->user_id;

        $today = Carbon::now()->format('Y-m-d');
        $todayAppointment = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.dentist_id', $curr)->whereDate('day', $today)->orderBy('day', 'asc')->get(['appointments.*', 'patients.name as patient_name']);

        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->where('appointments.dentist_id', $curr)->whereDate('day', '>', $today)->orderBy('day', 'asc')->paginate(10, ['appointments.*', 'patients.name as patient_name']);

        return view('dentists.dentistAppointment', ['appointments' => $appointments, 'todayAppointment' => $todayAppointment]);
    }

    public function viewAllAppointment()
    {
        $today = Carbon::now()->format('Y-m-d');
        $todayAppointment = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->whereDate('day', $today)->orderBy('day', 'asc')->get(['appointments.*', 'patients.name as patient_name', 'dentists.name as dentist_name']);

        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->whereDate('day', '>', $today)->orderBy('day', 'asc')->paginate(10, ['appointments.*', 'patients.name as patient_name', 'dentists.name as dentist_name']);

        return view('receptionist.allAppointment', ['appointments' => $appointments, 'todayAppointment' => $todayAppointment]);
    }

    public function viewHistoryAppointment()
    {
        $today = Carbon::now()->format('Y-m-d');

        $appointments = Appointment::join('patients', 'patients.patient_id', '=', 'appointments.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')->whereDate('day', '<', $today)->orderBy('day', 'desc')->paginate(10, ['appointments.*', 'patients.name as patient_name', 'dentists.name as dentist_name']);

        return view('receptionist.historyAppointment', ['appointments' => $appointments]);
    }

    public function addMakeAppointment(Request $request)
    {
        $role = Auth::user()->role;

        if ($role == 1) {
            $request->validate([
                'patient_id' => [
                    'required',
                    Rule::unique('appointments')->where(function ($query) use ($request) {
                        return $query->where('day', $request->date)
                            ->where('time', $request->time)
                            ->where('patient_id', $request->patient_id);
                    })->ignore($request->id),
                ],
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
                'patient_id.required' => 'Please select the patient.',
                'patient_id.unique' => 'You already have an appointment on the same time and date.',
                'date.required' => 'Please select the date.',
                'time.required' => 'Please select the time.',
                'dentist_id.required' => 'Please select the dentist.',
                'dentist_id.unique' => 'Dentist already have an appointment on the same time and date.',
            ]);
        } elseif ($role == 2) {
            $request->validate([
                'patient_id' => [
                    'required',
                    Rule::unique('appointments')->where(function ($query) use ($request) {
                        return $query->where('day', $request->date)
                            ->where('time', $request->time)
                            ->where('patient_id', $request->patient_id);
                    })->ignore($request->id),
                ],
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
                'patient_id.required' => 'Please select the patient.',
                'patient_id.unique' => 'Patient already have an appointment on the same time and date.',
                'date.required' => 'Please select the date.',
                'time.required' => 'Please select the time.',
                'dentist_id.required' => 'Please select the dentist.',
                'dentist_id.unique' => 'You already have an appointment on the same time and date.',
            ]);
        } else {
            $request->validate([
                'patient_id' => [
                    'required',
                    Rule::unique('appointments')->where(function ($query) use ($request) {
                        return $query->where('day', $request->date)
                            ->where('time', $request->time)
                            ->where('patient_id', $request->patient_id);
                    })->ignore($request->id),
                ],
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
                'patient_id.required' => 'Please select the patient.',
                'patient_id.unique' => 'Patient already have an appointment on the same time and date.',
                'date.required' => 'Please select the date.',
                'time.required' => 'Please select the time.',
                'dentist_id.required' => 'Please select the dentist.',
                'dentist_id.unique' => 'Dentist already have an appointment on the same time and date.',
            ]);
        }


        $appointment = new Appointment;

        $appointment->day = $request->input('date');
        $appointment->time = $request->input('time');
        $appointment->patient_id = $request->input('patient_id');
        $appointment->dentist_id = $request->input('dentist_id');
        $appointment->status = $request->input('status');

        $appointment->save();

        session()->flash('message', 'Appointment has been made.');
        
        if ($role == 1) {
            return redirect()->route('patients.appointment.view');
        } elseif ($role == 2) {
            return redirect()->route('dentist.appointment.view');
        } else {
            return redirect()->route('receptionist.allAppointment.view');
        }
    }

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