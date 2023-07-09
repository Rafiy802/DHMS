<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Dompdf\Dompdf;
use App\Models\Medicine;
use App\Models\Receipt;
use App\Models\Treatment;
use Dompdf\Options;
use Illuminate\Http\Request;
use Response;

class InvoiceController extends Controller
{
    //

    public function generateInvoice($id)
    {
        $receipt = Receipt::with('medicines', 'treatments')->findOrFail($id);
        $patient = Receipt::join('patients', 'patients.user_id', '=', 'receipts.patient_id')->where('receipts.id', $id)->get(['receipts.*','patients.name as patient_name']);
        // $patient = Patient::join('receipts', 'receipts.patient_id', '=', 'patients.patient_id')->where('receipts.patient_id', $id)->get(['receipts.*','patients.name as patient_name']);
       
        // $todayAppointment = Appointment::join('patients', 'patients.user_id', '=', 'appointments.patient_id')
        //     ->join('dentists', 'dentists.dentist_id', '=', 'appointments.dentist_id')
        //     ->where('appointments.patient_id', $curr)
        //     ->whereDate('day', $today)
        //     ->orderBy('day', 'asc')
        //     ->get(['appointments.*', 'dentists.name as dentist_name']);

        $medicines = $receipt->medicines;
        $treatments = $receipt->treatments;

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->setBasePath(public_path());

        $dompdf->loadHtml(view('dentists.generatePDF', compact('receipt', 'medicines', 'treatments', 'patient'))->render());

        // $dompdf->addStyle(file_get_contents(public_path('assets/css/style.css')));

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        //return $dompdf->stream('invoice.pdf');

        $output = $dompdf->output();
        $response = Response::make($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=invoice.pdf',
        ]);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'sameorigin');
        $response->headers->set('Content-Security-Policy', "frame-ancestors 'self'");

        return $response;
    }

}
