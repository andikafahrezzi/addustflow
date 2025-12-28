<h3>Payments for Invoice #{{ $invoice->invoice_number }}</h3>

<p><strong>Total Invoice:</strong> {{ number_format($invoice->amount,2) }}</p>
<p><strong>Total Paid:</strong> {{ number_format($totalPaid,2) }}</p>

<a href="{{ route('finance.payments.create', $invoice->id) }}"
   class="btn btn-success mb-3">Tambah Pembayaran</a>

<table class="table table-bordered">
    <tr>
        <th>Tanggal</th>
        <th>Metode</th>
        <th>Amount</th>
        <th>Aksi</th>
    </tr>


    @foreach($payments as $p)
<tr>
    <td>{{ $p->payment_date}}</td>
    <td>{{ $p->method ?? '-' }}</td>
    <td>{{ number_format($p->amount, 2) }}</td>
    <td>
        <!-- PERBAIKAN: ganti $e->id dengan $p->id -->
        <form action="{{ route('finance.payments.destroy', [
            'invoice' => $p->invoice_id,  // ID invoice dari payment
            'payment' => $p->id           // ID payment itu sendiri
        ]) }}" method="POST" 
          onsubmit="return confirm('Yakin hapus payment ini?')"
          style="display:inline;">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                Delete
            </button>
        </form>
    </td>
</tr>
@endforeach
</table>
