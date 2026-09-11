<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Barryvdh\DomPDF\Facade\Pdf;

class QuotePdfController extends Controller
{
    public function __invoke(Quote $quote)
    {
        $quote->load(['client', 'items']);

        $pdf = Pdf::loadView('pdf.quote', [
            'quote' => $quote,
        ])->setPaper('letter');

        return $pdf->download(($quote->folio ?: 'cotizacion') . '.pdf');
    }
}