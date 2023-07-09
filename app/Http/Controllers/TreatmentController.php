<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    //
    public function viewAllTreatments(){

        $treatments = Treatment::simplePaginate(10);

        //$dentists = User::where('role','=','2')->get();

        return view('receptionist.manageTreatments', ['treatments' => $treatments]);
    }

    public function addNewTreatment(){

        $treatment = new Treatment;

        $treatment->name = request('name');
        $treatment->price = request('price');

        $treatment->save();

        return redirect()->route('receptionist.treatment.viewAll');
    }

    public function viewEditTreatment($id)
    {

        $treatment = Treatment::find($id);

        return view('receptionist.editTreatment', ['treatment' => $treatment]);
    }

    public function editTreatment($id)
    {

        $treatment = Treatment::findOrFail($id);

        $treatment->name = request('name');
        $treatment->price = request('price');

        $treatment->save();

        return redirect()->route('receptionist.treatment.viewAll');
    }

    public function deleteTreatment($id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->delete();

        return redirect()->route('receptionist.treatment.viewAll');
    }
    
}
