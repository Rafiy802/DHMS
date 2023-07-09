<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    //

    public function viewAllMedicine(){

        $medicines = Medicine::simplePaginate(10);

        return view('receptionist.manageMedicine', ['medicines' => $medicines]);
    }

    public function addNewMedicine(request $data){

        $data->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9\s]+$/'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ], [
            'name.required' => 'Please insert the name.',
            'price.required' => 'Please insert the price.',
            'quantity.required' => 'Please insert the quantity.',
            'price.numeric' => 'Price must be number.',
            'quantity.numeric' => 'Quantity must be number',
        ]);
        
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

    public function editMedicine($id, request $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9\s]+$/'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ], [
            'name.required' => 'Please insert the name.',
            'price.required' => 'Please insert the price.',
            'quantity.required' => 'Please insert the quantity.',
            'price.numeric' => 'Price must be number.',
            'quantity.numeric' => 'Quantity must be number',
        ]);

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
