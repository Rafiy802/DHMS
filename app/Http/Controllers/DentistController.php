<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DentistController extends Controller
{
    //
    public function viewAllDentist(){

        $dentist = Dentist::simplePaginate(10);

        return view('receptionist.manageDentist', ['dentists' => $dentist]);
    }

    public function addNewDentist(request $data)
    {

        $data->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'IC' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'mobile_num' => ['required'],
            'birthdate' => ['required', 'date'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'dentist_id.required' => 'Please select the dentist.',
            'date.required' => 'Please select the date.',
            'time.required' => 'Please select the time.',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'birthdate' => $data['birthdate'],
            'mobile_num' => $data['mobile_num'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $dentist = Dentist::create([
            'dentist_id' => $user->user_id,
            'user_id' => $user->user_id,
            'name' => $data['name'],
            'ICnum' => $data['IC'],
        ]);

        return redirect()->route('receptionist.dentist.manage');

    }

    public function viewDentistInfo($id){

        $dentists = Dentist::join('users', 'users.user_id', '=', 'dentists.dentist_id')->where('dentists.dentist_id',$id)->get(['users.*', 'dentists.ICnum as IC']);

        return view('receptionist.viewDentist', ['dentists' => $dentists]);
    }

    public function viewEditDentistInfo($id){

        $dentists = Dentist::join('users', 'users.user_id', '=', 'dentists.dentist_id')->where('dentists.dentist_id',$id)->get(['users.*', 'dentists.ICnum as IC']);

        return view('receptionist.editDentistInfo', ['dentists' => $dentists]);
    }

    public function editDentistInfo($id)
    {

        $user = User::findOrFail($id);
        $dentist = Dentist::findOrFail($id);


        $user->name = request('name');
        $user->address = request('address');
        $user->mobile_num = request('mobile_num');

        $user->save();
        $dentist->save();

        return redirect()->route('receptionist.dentist.view', $id);
    }
}