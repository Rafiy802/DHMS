<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    //

    public function viewAllMedicine(){

        $medicines = Medicine::all();

        //$dentists = User::where('role','=','2')->get();

        return view('receptionist.manageMedicine', ['medicines' => $medicines]);
    }

    public function addNewMedicine(){

        $medicine = new Medicine;

        $medicine->name = request('name');
        $medicine->price = request('price');
        $medicine->quantity = request('quantity');

        $medicine->save();

        return redirect()->route('receptionist.medicine.viewAll');
    }

    public function viewEditMedicine($id)
    {

        $medicine = Medicine::find($id);

        return view('receptionist.editMedicine', ['medicine' => $medicine]);
    }

    public function editMedicine($id)
    {

        $medicine = Medicine::findOrFail($id);

        $medicine->name = request('name');
        $medicine->price = request('price');
        $medicine->quantity = request('quantity');

        $medicine->save();

        return redirect()->route('receptionist.medicine.viewAll');
    }

    public function deleteMedicine($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();

        return redirect()->route('receptionist.medicine.viewAll');
    }
}
