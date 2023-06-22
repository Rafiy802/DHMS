<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Receipt;
use App\Models\Treatment;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    //
    public function viewNewReceipt(){

        $medicines = Medicine::all();
        $treatments = Treatment::all();

        return view('dentists.addReceipt', ['medicines' => $medicines, 'treatments' => $treatments]);
    }


    public function viewAllReceipt(){

        $receipts = Receipt::all();

        return view('dentists.manageReceipt', ['receipts' => $receipts]);
    }


    public function viewSelectedReceipt($id)
    {
        $receipt = Receipt::with('medicines', 'treatments')->findOrFail($id);

        $medicines = $receipt->medicines;
        $treatments = $receipt->treatments;

        return view('dentists.viewReceipt', compact('receipt', 'medicines', 'treatments'));
    }


    public function addNewReceipt(Request $request){

        $receipt = new Receipt;

        $receipt->Notes = request('notes');
        $receipt->save();

        $medicines = request('medicine');
        $quantity = request('quantity');

        $treatments = request('treatment');


        $index = 0;
        foreach($medicines as $med){
            $medic = Medicine::findOrFail($med);

            $price = $medic->price;

            $taken_qua = $quantity[$index]; 
            $medic->quantity = $medic->quantity - $taken_qua;
            
            $medic->save();

            $receipt->medicines()->attach($med, ['quantity' => $taken_qua, 'price' => $price]);

            $index++;
        }

        foreach($treatments as $treatment){
            $treat = Medicine::findOrFail($treatment);

            $treat_price = $treat->price;

            $receipt->treatments()->attach($treatment, ['price' => $treat_price]);
        }
        

        return redirect()->route('dentist.receipt.viewAll');
    }
}
