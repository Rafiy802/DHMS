<?php

namespace App\Http\Controllers;

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

        $medicines = $receipt->medicines;
        $treatments = $receipt->treatments;

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->setBasePath(public_path());

        $dompdf->loadHtml(view('dentists.generatePDF', compact('receipt', 'medicines', 'treatments'))->render());

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
