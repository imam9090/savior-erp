<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class InvoicePdfController extends Controller
{
    public function __invoke(Invoice $invoice)
    {
        $user = Auth::user();

        if ($user->role->value === 'customer' && $invoice->client_id !== $user->id) {
            throw new AccessDeniedHttpException('Anda tidak memiliki akses ke invoice ini.');
        }

        $invoice->load('items', 'client');

        $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $invoice]);

        return $pdf->download($invoice->invoice_number . '.pdf');
    }
}