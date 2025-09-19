<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\Appointment;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        $appointmentDetails = Appointment::with(['branch', 'refereeDoctor', 'pet', 'pet.petParent', 'tests'])
                    ->where('id', $id)
                    ->first();

        if (!$appointmentDetails) {
            abort(404, "Appointment not found");
        }
        

        $pdf = PDF::loadView('Admin.Invoice.invoice', compact('appointmentDetails'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('invoice_'.$id.'.pdf');
    }



}
