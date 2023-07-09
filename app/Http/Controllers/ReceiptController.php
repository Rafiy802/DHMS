<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Receipt;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    //
    public function viewNewReceipt($id)
    {

        $patient = Patient::findOrFail($id);
        $medicines = Medicine::all();
        $treatments = Treatment::all();

        return view('dentists.addReceipt', ['medicines' => $medicines, 'treatments' => $treatments, 'patient' => $patient]);
    }


    public function viewAllReceipt($id)
    {

        $receipts = Receipt::join('dentists', 'dentists.user_id', '=', 'receipts.dentist_id')->where('patient_id', $id)->orderBy('created_at', 'desc')->simplePaginate(10, ['receipts.*', 'dentists.name as dentist_name']);
        $patient = Patient::findOrFail($id);

        return view('receptionist.manageReceipt', ['receipts' => $receipts, 'patient' => $patient]);
    }

    public function viewDentistReceipt($id)
    {
        $curr = Auth::user()->user_id;
        $patient = Patient::findOrFail($id);
        $receipts = Receipt::join('patients', 'patients.user_id', '=', 'receipts.patient_id')->join('dentists', 'dentists.dentist_id', '=', 'receipts.dentist_id')->where('receipts.dentist_id', $curr)->where('receipts.patient_id', $id)->orderBy('created_at', 'desc')->simplePaginate(10, ['receipts.*']);

        return view('dentists.manageReceipt', ['receipts' => $receipts, 'patient' => $patient]);
    }


    public function viewSelectedReceipt($id)
    {
        $receipt = Receipt::with('medicines', 'treatments')->findOrFail($id);

        $medicines = $receipt->medicines;
        $treatments = $receipt->treatments;

        if (Auth::user()->role == 2) {
            return view('dentists.viewReceipt', compact('receipt', 'medicines', 'treatments'));
        } else {
            return view('receptionist.viewReceipt', compact('receipt', 'medicines', 'treatments'));
        }

    }


    public function addNewReceipt(Request $request, $id)
    {

        $curr = Auth::user()->user_id;

        $receipt = new Receipt;

        $receipt->patient_id = $id;
        $receipt->dentist_id = $curr;

        $receipt->Notes = request('notes');
        $receipt->save();

        $medicines = request('medicine');
        $quantity = request('quantity');

        $treatments = request('treatment');


        $index = 0;
        foreach ($medicines as $med) {
            if ($med != "") {
                $medic = Medicine::findOrFail($med);

                $price = $medic->price;

                $taken_qua = $quantity[$index];
                $medic->quantity = $medic->quantity - $taken_qua;

                $medic->save();

                $receipt->medicines()->attach($med, ['quantity' => $taken_qua, 'price' => $price]);

                $index++;
            }
        }

        foreach ($treatments as $treatment) {
            if ($treatment != "") {
                $treat = Medicine::findOrFail($treatment);

                $treat_price = $treat->price;

                $receipt->treatments()->attach($treatment, ['price' => $treat_price]);
            }
        }


        return redirect()->route('dentist.receipt.viewAll', $id);
    }
}