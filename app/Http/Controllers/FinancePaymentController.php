<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;

class FinancePaymentController extends Controller
{
    /** Tampilkan list payment untuk invoice */
    public function index(Invoice $invoice)
    {
        $payments = Payment::where('invoice_id', $invoice->id)->get();
        $totalPaid = $payments->sum('amount');

        return view('finance.payments.index', compact('invoice','payments','totalPaid'));
    }

    /** Form tambah payment */
    public function create(Invoice $invoice)
    {
        return view('finance.payments.create', compact('invoice'));
    }

    /** Simpan payment */
    public function store(Request $request, Invoice $invoice)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'method' => 'nullable|string|max:255',
        ]);

        Payment::create([
            'invoice_id'   => $invoice->id,
            'amount'       => $request->amount,
            'payment_date' => $request->payment_date,
            'method'       => $request->method,
            'received_by'  => Auth::id(),
        ]);

        // cek apakah invoice sudah lunas
        $totalPaid = Payment::where('invoice_id', $invoice->id)->sum('amount');

        if ($totalPaid >= $invoice->amount) {
            $invoice->update(['status' => 'paid']);
        }

        return redirect()
            ->route('finance.payments.index', $invoice->id)
            ->with('success','Pembayaran berhasil dicatat.');
    }
    public function destroy(Invoice $invoice, Payment $payment)
    {
        // Validasi: Pastikan payment milik invoice ini
  if ((int)$payment->invoice_id !== (int)$invoice->id) {
        abort(403, 'Payment tidak terkait dengan invoice ini.');
    }
    
    // Cara 2: Gunakan != (loose comparison) TAPI dengan trim
    if (trim($payment->invoice_id) != trim($invoice->id)) {
        abort(403, 'Payment tidak terkait dengan invoice ini.');
    }
    
    // Cara 3: Validasi dengan database query
    if (!$payment->invoice()->where('id', $invoice->id)->exists()) {
        abort(403, 'Payment tidak terkait dengan invoice ini.');
    }
        // Delete payment
        $payment->delete();
        
        // Redirect dengan success message
        return redirect()
            ->route('finance.payments.index', $invoice->id) // atau ke index
            ->with('success', 'Payment berhasil dihapus.');
    }
}
