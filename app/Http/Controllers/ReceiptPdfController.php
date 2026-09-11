<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceiptPdfController extends Controller
{
    public function __invoke(Receipt $receipt)
    {
        $receipt->load(['quote.client']);

        $pdf = Pdf::loadView('pdf.receipt', [
            'receipt' => $receipt,
        ])->setPaper('letter');

        return $pdf->download(($receipt->folio ?: 'recibo') . '.pdf');
    }
}